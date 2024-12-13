<?php 
include_once __DIR__ . '/../commun/header.php';
require_once('../BDD/database.php');// Inclusion du fichier de connexion à la BDD

// Démarrer la session
session_start();

// Variables pour afficher les messages
$error = '';
$success = '';

// Vérification du formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $mot_de_passe = $_POST['mot_de_passe'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $role = $_POST['role']; // Role : 'Sportif', 'Coach', 'Admin'
    $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;

    if ($nom && $prenom && $email && $mot_de_passe && $telephone && $adresse && $role) {
        try {
            // Vérification si l'email est déjà utilisé
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM Utilisateur WHERE Email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $emailExists = $stmt->fetchColumn();

            if ($emailExists) {
                $error = "Cet email est déjà utilisé.";
            } else {
                // Hacher le mot de passe
                $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Gestion de l'upload de photo
                $photoPath = null;
                if ($photo && $photo['tmp_name']) {
                    $photoPath = 'uploads/' . uniqid() . '_' . $photo['name'];
                    move_uploaded_file($photo['tmp_name'], $photoPath);
                }

                // Insérer le nouvel utilisateur
                $stmt = $pdo->prepare('
                    INSERT INTO Utilisateur 
                    (Nom, Prenom, Email, Mot_de_passe, Telephone, Adresse, Role, Photo) 
                    VALUES 
                    (:nom, :prenom, :email, :mot_de_passe, :telephone, :adresse, :role, :photo)
                ');
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mot_de_passe', $hashedPassword);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':photo', $photoPath);

                $stmt->execute();

                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        $error = 'Veuillez remplir tous les champs obligatoires.';
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center text-primary mb-4">Inscription</h2>

            <!-- Messages de feedback -->
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <!-- Formulaire d'inscription -->
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea class="form-control" id="adresse" name="adresse" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="Sportif">Sportif</option>
                        <option value="Coach">Coach</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil (facultative)</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>

            <!-- Lien vers la connexion -->
            <div class="text-center mt-3">
                <p>Déjà inscrit ? <a href="../View/connexion.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
