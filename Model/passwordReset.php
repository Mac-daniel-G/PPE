<?php
// app/Models/PasswordReset.php
class PasswordReset {
    private $pdo;
    private $table = 'password_resets';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createToken($email, $token, $expires_at) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (email, token, expires_at) VALUES (:email, :token, :expires_at)");
        return $stmt->execute([
            ':email' => $email,
            ':token' => $token,
            ':expires_at' => $expires_at
        ]);
    }

    public function getValidToken($token) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE token = :token AND expires_at > NOW()");
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteToken($token) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE token = :token");
        return $stmt->execute([':token' => $token]);
    }
}
