<?php

// Liste des pages autorisées
$allowedPages = [
    'accueil' => 'View/accueil.php',
    'connexion' => 'View/connexion.php',
    'inscription' => 'View/inscription.php',
    'programmes' => __DIR__ . '/../programmes/index.php',
    'salles' => 'View/salles.php'
];

// Récupérer la page demandée
$page = $_GET['page'] ?? 'accueil'; // Par défaut, 'accueil'

// Vérifier si la page est autorisée et existe
if (array_key_exists($page, $allowedPages)) {
    $filePath = __DIR__ . '/' . $allowedPages[$page];

    if (file_exists($filePath)) {
        include($filePath);
    } else {
        http_response_code(404);
        echo "Erreur 404 : La page demandée est introuvable.";
    }
} else {
    // Gestion des accès à des pages non autorisées
    http_response_code(403);
    echo "Erreur 403 : Accès refusé.";
}

switch($page){
    case 'programme':
        include ('view/programmes/index.php');
        break;
}

?>