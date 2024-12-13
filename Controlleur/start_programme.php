<?php
require_once '../commun/db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $programmeId = $_POST['programme_id'];

    try {
        $query = "INSERT INTO user_programmes (user_id, programme_id, date_debut) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId, $programmeId]);

        header('Location: programme_suivi.php');
        exit;
    } catch (Exception $e) {
        die("Erreur lors de l'inscription au programme : " . $e->getMessage());
    }
}

?>