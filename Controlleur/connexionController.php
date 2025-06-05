<?php
require_once __DIR__ . '/../Models/User.php';

class ConnexionController {
    private $pdo;
    public $error = '';
    public $success = '';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            if ($email && $password) {
                $userModel = new User($this->pdo);
                $user = $userModel->findByEmail($email);

                if ($user && $userModel->verifyPassword($password, $user['MotDePasse'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['Role'] === 'sportif' ? $user['Id_sportif'] : $user['Id_coach'];
                    $_SESSION['user_name'] = $user['Nom'] . ' ' . $user['Prenom'];
                    $_SESSION['user_role'] = $user['Role'];

                    $this->success = 'Connexion réussie ! Redirection en cours...';
                    header('Refresh: 2; URL=index.php?page=accueil');
                    exit();
                } else {
                    $this->error = 'Email ou mot de passe incorrect.';
                }
            } else {
                $this->error = 'Veuillez remplir tous les champs correctement.';
            }
        }
    }
}
