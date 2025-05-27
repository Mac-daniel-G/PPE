<?php
// Inclusion du contrôleur des coachs
require_once '../../Controleur/coachController.php';

// Définir le type de contenu de la réponse en JSON
header('Content-Type: application/json');

try {
    // Appeler la méthode pour récupérer tous les coachs
    $coaches = coachController::getAllcoaches();

    // Vérifier si des coachs ont été trouvés
    if (!empty($coaches)) {
        // Encoder les données au format JSON et les renvoyer
        echo json_encode([
            "status" => "success",
            "data" => $coaches
        ]);
    } else {
        // Si aucun coach n'a été trouvé, renvoyer une réponse vide
        echo json_encode([
            "status" => "success",
            "data" => [],
            "message" => "Aucun coach trouvé."
        ]);
    }
} catch (Exception $e) {
    // Gestion des erreurs - renvoyer un message d'erreur en JSON
    echo json_encode([
        "status" => "error",
        "message" => "Une erreur s'est produite lors de la récupération des coachs.",
        "details" => $e->getMessage()
    ]);
}
?>
