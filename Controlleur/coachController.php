<?php
// Inclure le fichier du contrôleur des salles
require_once '../../Controleur/salleController.php';

// Définir le type de contenu pour indiquer que la réponse sera au format JSON
header('Content-Type: application/json');

try {
    // Récupérer toutes les salles à partir du contrôleur
    $salles = SalleController::getAllSalles();

    // Vérifier si des données sont retournées
    if (!empty($salles)) {
        // Si des salles existent, on renvoie les données avec un message de succès
        echo json_encode([
            "status" => "success", // Indique que la requête a réussi
            "data" => $salles,    // Contient les informations des salles
            "message" => "Les salles ont été récupérées avec succès."
        ]);
    } else {
        // Si aucune salle n'est disponible, renvoyer une réponse vide avec un message explicatif
        echo json_encode([
            "status" => "success",
            "data" => [],
            "message" => "Aucune salle disponible."
        ]);
    }
} catch (PDOException $e) {
    // Gestion des erreurs liées à la base de données
    echo json_encode([
        "status" => "error",
        "message" => "Erreur lors de la récupération des salles.",
        "details" => $e->getMessage() // À masquer en production pour éviter des fuites d'informations
    ]);
} catch (Exception $e) {
    // Gestion des erreurs générales
    echo json_encode([
        "status" => "error",
        "message" => "Une erreur inattendue s'est produite.",
        "details" => $e->getMessage() // Message d'erreur pour débogage
    ]);
}
?>
