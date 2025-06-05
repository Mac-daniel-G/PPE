<?php
include_once __DIR__ . '/../commun/header.php';
require_once __DIR__ . '/../BDD/database.php';

$error = '';
$success = '';

$nom = $prenom = $email = $telephone = $mot_de_passe = $confirm_mot_de_passe = '';
$role = $specialite = $objectif = '';
$age = $taille = $poids = null;
$sexe = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $telephone = trim($_POST['telephone'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirm_mot_de_passe = $_POST['confirm_mot_de_passe'] ?? '';
    $role = $_POST['role'] ?? '';

    $specialite = trim($_POST['specialite'] ?? '');
    $age = isset($_POST['age']) ? intval($_POST['age']) : null;
    $sexe = isset($_POST['sexe']) && in_array($_POST['sexe'], ['Homme', 'Femme']) ? $_POST['sexe'] : null;
    $taille = isset($_POST['taille']) ? floatval($_POST['taille']) : null;
    $poids = isset($_POST['poids']) ? floatval($_POST['poids']) : null;
    $objectif = trim($_POST['objectif'] ?? '');

    if (!$nom || !$prenom || !$email || !$telephone || !$mot_de_passe || !$confirm_mot_de_passe || !$role) {
        $error = 'Veuillez remplir tous les champs obligatoires.';
    } elseif ($mot_de_passe !== $confirm_mot_de_passe) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/', $mot_de_passe)) {
        $error = "Le mot de passe doit contenir au moins 12 caractères, avec majuscule, minuscule, chiffre et caractère spécial.";
    } else {
        try {
            // Vérifier si l'email existe déjà dans coach ou sportif
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM coach WHERE Email = :email');
            $stmt->execute(['email' => $email]);
            $coachExists = $stmt->fetchColumn();

            $stmt = $pdo->prepare('SELECT COUNT(*) FROM sportif WHERE Email = :email');
            $stmt->execute(['email' => $email]);
            $sportifExists = $stmt->fetchColumn();

            if ($coachExists > 0 || $sportifExists > 0) {
                $error = "Cet email est déjà utilisé.";
            } else {
                $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                if ($role === 'coach') {
                    $stmt = $pdo->prepare('INSERT INTO coach (Nom, Prenom, Specialite, Email, Telephone, motDePasse) 
                                           VALUES (:nom, :prenom, :specialite, :email, :telephone, :motDePasse)');
                    $stmt->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'specialite' => $specialite,
                        'email' => $email,
                        'telephone' => $telephone,
                        'motDePasse' => $hashedPassword
                    ]);
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    
                } elseif ($role === 'sportif') {
                    $stmt = $pdo->prepare('INSERT INTO sportif (Nom, Prenom, Age, Sexe, Taille, Poids, Objectif, Email, Telephone, motDePasse) 
                                           VALUES (:nom, :prenom, :age, :sexe, :taille, :poids, :objectif, :email, :telephone, :motDePasse)');
                    $stmt->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'age' => $age,
                        'sexe' => $sexe,
                        'taille' => $taille,
                        'poids' => $poids,
                        'objectif' => $objectif,
                        'email' => $email,
                        'telephone' => $telephone,
                        'motDePasse' => $hashedPassword
                    ]);
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                }                                
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center text-primary mb-4">Inscription</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($prenom) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($telephone) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$"
                           title="Au moins 12 caractères, avec majuscule, minuscule, chiffre et caractère spécial">
                </div>
                <div class="mb-3">
                    <label for="confirm_mot_de_passe" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_mot_de_passe" name="confirm_mot_de_passe" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Vous êtes :</label>
                    <select class="form-select" id="role" name="role" required onchange="toggleFields()">
                        <option value="">Sélectionnez</option>
                        <option value="sportif" <?= ($role === 'sportif') ? 'selected' : '' ?>>Sportif</option>
                        <option value="coach" <?= ($role === 'coach') ? 'selected' : '' ?>>Coach</option>
                    </select>
                </div>

                <div id="coachFields" style="display: none;">
                    <div class="mb-3">
                        <label for="specialite" class="form-label">Spécialité</label>
                        <input type="text" class="form-control" id="specialite" name="specialite" value="<?= htmlspecialchars($specialite) ?>">
                    </div>
                </div>

                <div id="sportifFields" style="display: none;">
                    <div class="mb-3">
                        <label for="age" class="form-label">Âge</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($age) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sexe" class="form-label">Sexe</label>
                        <select class="form-select" id="sexe" name="sexe">
                            <option value="Homme" <?= $sexe === 'Homme' ? 'selected' : '' ?>>Homme</option>
                            <option value="Femme" <?= $sexe === 'Femme' ? 'selected' : '' ?>>Femme</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taille" class="form-label">Taille (m)</label>
                        <input type="number" step="0.01" class="form-control" id="taille" name="taille" value="<?= htmlspecialchars($taille) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="poids" class="form-label">Poids (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="poids" name="poids" value="<?= htmlspecialchars($poids) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="objectif" class="form-label">Objectif</label>
                        <input type="text" class="form-control" id="objectif" name="objectif" value="<?= htmlspecialchars($objectif) ?>">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleFields() {
    const role = document.getElementById("role").value;
    document.getElementById("coachFields").style.display = role === "coach" ? "block" : "none";
    document.getElementById("sportifFields").style.display = role === "sportif" ? "block" : "none";
}
document.addEventListener("DOMContentLoaded", toggleFields);
</script>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
