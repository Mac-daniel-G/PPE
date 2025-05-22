<?php
// Connexion à la base de données
require_once(__DIR__ . '/../../BDD/database.php');

// Vérifie si l'utilisateur est connecté
session_start();  // Assure-toi que la session est démarrée

// Vérifie si l'ID utilisateur est dans la session et s'il est valide
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== NULL) {
    $id_client = $_SESSION['user_id']; // Récupère l'ID de l'utilisateur connecté

    // Vérifie si l'ID sportif existe dans la table 'sportif'
    $stmt = $pdo->prepare("SELECT Id_Sportif FROM sportif WHERE Id_Sportif = ?");
    $stmt->execute([$id_client]);
    $client_exists = $stmt->fetchColumn();

    if ($client_exists) {

        if (isset($_POST['id_produit'])) {
            $id_produit = $_POST['id_produit'];


            $query = "INSERT INTO panier (id_produit, id_client) VALUES (?, ?)";
            $stmt = $pdo->prepare($query);

            try {
                $stmt->execute([$id_produit, $id_client]);
                echo "article enregistrée avec succès !";
            } catch (Exception $e) {
                echo "Erreur lors de l'enregistrement de l'article : " . $e->getMessage();
            }
        } else {
            echo "Aucun article sélectionné.";
        }
    } else {
        echo "L'utilisateur connecté n'existe pas dans la base de données.";
    }
} else {
    echo "Utilisateur non connecté ou ID utilisateur invalide.";
}
?>
