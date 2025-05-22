<?php
// Connexion à la base de données
require_once(__DIR__ . '/../../BDD/database.php');

// Vérifie si l'utilisateur est connecté
session_start();  // Assure-toi que la session est démarrée

// Vérifie si l'ID utilisateur est dans la session et s'il est valide
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== NULL) {
    $sportif_id = $_SESSION['user_id']; // Récupère l'ID de l'utilisateur connecté

    // Vérifie si l'ID sportif existe dans la table 'sportif'
    $stmt = $pdo->prepare("SELECT Id_Sportif FROM sportif WHERE Id_Sportif = ?");
    $stmt->execute([$sportif_id]);
    $sportif_exists = $stmt->fetchColumn();

    if ($sportif_exists) {
        // Si l'utilisateur existe, on peut ajouter la réservation

        if (isset($_POST['programme_id'])) {
            $programme_id = $_POST['programme_id'];
            $date_reservation = date('Y-m-d H:i:s'); // Date et heure actuelle

            // Insertion de la réservation dans la table 'reservations'
            $query = "INSERT INTO reservations (programme_id, sportif_id, date_reservation) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($query);

            try {
                $stmt->execute([$programme_id, $sportif_id, $date_reservation]);
                echo "Réservation enregistrée avec succès !";
            } catch (Exception $e) {
                echo "Erreur lors de l'enregistrement de la réservation : " . $e->getMessage();
            }
        } else {
            echo "Aucun programme sélectionné.";
        }
    } else {
        echo "L'utilisateur connecté n'existe pas dans la base de données.";
    }
} else {
    echo "Utilisateur non connecté ou ID utilisateur invalide.";
}
?>
