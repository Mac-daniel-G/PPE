<?php
// app/Models/User.php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $sqlSportif = 'SELECT *, "sportif" as Role FROM sportif WHERE Email = :email';
        $stmt = $this->pdo->prepare($sqlSportif);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $sqlCoach = 'SELECT *, "coach" as Role FROM coach WHERE Email = :email';
            $stmt = $this->pdo->prepare($sqlCoach);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $user ?: null;
    }

    public function verifyPassword($plainPassword, $hash) {
        return password_verify($plainPassword, $hash);
    }
}
