<?php 
include_once __DIR__ . '/../commun/header.php';
require_once __DIR__ . '/../BDD/database.php';
require_once __DIR__ . '/../Controllers/ConnexionController.php';

$controller = new ConnexionController($pdo);
$controller->handleRequest();

$error = $controller->error;
$success = $controller->success;

session_start();

// Variables pour les messages
$error = '';
$success = '';

// Vérification du formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $userModel = new User($pdo); // Création du modèle utilisateur
        $user = $userModel->findByEmail($email); // Récupère l'utilisateur

        if ($user && $userModel->verifyPassword($password, $user['MotDePasse'])) {
            $_SESSION['user_id'] = $user['Role'] === 'sportif' ? $user['Id_sportif'] : $user['Id_coach'];
            $_SESSION['user_name'] = $user['Nom'] . ' ' . $user['Prenom'];
            $_SESSION['user_role'] = $user['Role'];

            $success = 'Connexion réussie ! Redirection en cours...';
            header('Refresh: 2; URL=index.php?page=accueil');
            exit();
        } else {
            $error = 'Email ou mot de passe incorrect.';
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

            <!-- Messages d'erreur ou succès -->
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
