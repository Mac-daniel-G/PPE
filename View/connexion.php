<?php 
include_once __DIR__ . '/../commun/header.php';
require_once __DIR__ . '/../BDD/database.php'; // Inclusion du fichier de connexion à la BDD

// Démarrer la session
// session_start();

// Variables pour afficher les messages
$error = '';
$success = '';

// Vérification du formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        try {
            // Rechercher d'abord dans la table Sportif
            $stmt = $pdo->prepare('SELECT *, "sportif" as Role FROM sportif WHERE Email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           

            // Si non trouvé, chercher dans la table Coach
            if (!$user) {
                $stmt = $pdo->prepare('SELECT *, "coach" as Role FROM coach WHERE Email = :email');
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
           
            // Si un utilisateur est trouvé et que le mot de passe est correct
            if ($user && password_verify($password, $user['MotDePasse'])) {
                // Connexion réussie
                $_SESSION['user_id'] = $user['Role'] === 'sportif' ? $user['Id_Sportif'] : $user['Id_Coach'];
                $_SESSION['user_name'] = $user['Nom'] . ' ' . $user['Prenom'];
                $_SESSION['user_role'] = $user['Role'];

                $success = 'Connexion réussie ! Redirection en cours...';
                header('Refresh: 2; URL=index.php?page=accueil'); // Redirection vers l'accueil
                exit();
            } else {
                $error = 'Email ou mot de passe incorrect.';
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la connexion : " . $e->getMessage();
        }
    } else {
        $error = 'Veuillez remplir tous les champs correctement.';
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center text-primary mb-4">Connexion</h2>

            <!-- Messages de feedback -->
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>

            <!-- Lien vers l'inscription -->
            <div class="text-center mt-3">
                <p>Pas encore inscrit ? <a href="index.php?page=inscription">Créer un compte</a></p>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
