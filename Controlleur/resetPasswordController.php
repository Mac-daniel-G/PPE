<?php
// app/Controllers/ResetPasswordController.php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/PasswordReset.php';

class ResetPasswordController {
    private $pdo;
    private $userModel;
    private $passwordResetModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->passwordResetModel = new PasswordReset($pdo);
    }

    public function request() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if ($email) {
                $user = $this->userModel->findByEmail($email);
                if ($user) {
                    // Générer token sécurisé
                    $token = bin2hex(random_bytes(16));
                    $expires_at = date('Y-m-d H:i:s', time() + 1800); // 30 min

                    // Sauvegarder token
                    $this->passwordResetModel->createToken($email, $token, $expires_at);

                    // Envoyer mail
                    $resetLink = "http://tondomaine.com/reset_password.php?token=$token";
                    $subject = "Réinitialisation de votre mot de passe";
                    $message = "Bonjour,\n\nPour réinitialiser votre mot de passe, veuillez cliquer sur ce lien : $resetLink\n\nCe lien expire dans 30 minutes.";
                    $headers = "From: no-reply@tondomaine.com";

                    mail($email, $subject, $message, $headers);

                    $success = "Un email vous a été envoyé avec le lien pour réinitialiser votre mot de passe.";
                    include __DIR__ . '/../Views/reset_request.php';
                    exit;
                } else {
                    $error = "Email non trouvé.";
                }
            } else {
                $error = "Email invalide.";
            }
        }

        include __DIR__ . '/../Views/reset_request.php';
    }

    public function resetForm() {
        $token = $_GET['token'] ?? '';
        if (!$token || !$this->passwordResetModel->getValidToken($token)) {
            die('Lien de réinitialisation invalide ou expiré.');
        }
        include __DIR__ . '/../Views/reset_form.php';
    }

    public function reset() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            if (!$token || !$this->passwordResetModel->getValidToken($token)) {
                die('Lien de réinitialisation invalide ou expiré.');
            }

            if ($password !== $passwordConfirm) {
                $error = "Les mots de passe ne correspondent pas.";
                include __DIR__ . '/../Views/reset_form.php';
                exit;
            }

            if (strlen($password) < 12 || 
                !preg_match('/[A-Z]/', $password) || 
                !preg_match('/[a-z]/', $password) || 
                !preg_match('/[\W]/', $password)) {
                $error = "Le mot de passe doit faire au moins 12 caractères, avec majuscule, minuscule, et caractère spécial.";
                include __DIR__ . '/../Views/reset_form.php';
                exit;
            }

            // Récupérer email via token
            $tokenData = $this->passwordResetModel->getValidToken($token);
            $email = $tokenData['email'];

            // Trouver utilisateur
            $user = $this->userModel->findByEmail($email);

            if ($user) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // Mettre à jour mot de passe dans la bonne table (sportif ou coach)
                $table = $user['Role'] === 'sportif' ? 'sportif' : 'coach';
                $idColumn = $user['Role'] === 'sportif' ? 'Id_sportif' : 'Id_coach';

                $stmt = $this->pdo->prepare("UPDATE $table SET motDePasse = :password WHERE Email = :email");
                $stmt->execute([':password' => $hashedPassword, ':email' => $email]);

                // Supprimer token
                $this->passwordResetModel->deleteToken($token);

                $success = "Mot de passe réinitialisé avec succès. Vous pouvez maintenant vous connecter.";
                include __DIR__ . '/../Views/reset_form.php';
                exit;
            } else {
                die("Utilisateur introuvable.");
            }
        }
    }
}