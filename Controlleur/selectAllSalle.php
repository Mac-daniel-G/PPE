<?php
// Vérifier si le fichier contrôleur existe avant inclusion
if (!file_exists('../../Controleur/salleController.php')) {
    http_response_code(500); // Erreur serveur
    echo json_encode([
        "status" => "error",
        "message" => "Fichier du contrôleur introuvable."
    ]);
    exit;
}

require_once '../../Controleur/salleController.php';

// Définir le type de contenu de la réponse en JSON
header('Content-Type: application/json');

try {
    // Récupérer toutes les salles via le contrôleur
    $salles = SalleController::getAllSalles();

    // Répondre avec les données ou une liste vide
    echo json_encode([
        "status" => "success",
        "data" => $salles ?? [],
        "message" => empty($salles) ? "Aucune salle disponible." : "Les salles ont été récupérées avec succès."
    ]);
} catch (PDOException $e) {
    // Masquer les détails des erreurs en production
    http_response_code(500); // Erreur serveur
    echo json_encode([
        "status" => "error",
        "message" => "Erreur lors de la récupération des salles.",
    ]);
} catch (Exception $e) {
    http_response_code(500); // Erreur serveur
    echo json_encode([
        "status" => "error",
        "message" => "Une erreur inattendue s'est produite."
    ]);
}
?>