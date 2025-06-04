<?php

// Liste des pages autorisées
$allowedPages = [
    'accueil' => 'View/accueil.php',
    'connexion' => __DIR__ . '/../connexion.php',
    'inscription' => __DIR__ . '/../inscription.php',
    'programmes' => __DIR__ . '/../programmes/index.php',
    'salles' => __DIR__ . '/../salle.php'
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
        echo "";
    }
} 

switch($page){
    case 'programme':
        include ('View/programmes/index.php');
        break;
    case 'salle':
        include ('View/salle.php');
        break;
    case 'inscription':
        include ('View/inscription.php');
        break;
    case 'connexion':
        include ('View/connexion.php');
        break;
    case 'mentions_legales':
        include ('View/mentions_legales.php');
        break;
    case 'cgu':
        include ('View/cgu.php');
        break;
    case 'boutique':
        include ('View/boutique.php');
        break;
    case 'contact':
        include ('View/contact.php');
        break;
    case 'deconnexion':
        include ('View/deconnexion.php');
        break;
    case 'compte':
        include ('View/compte.php');
        break;
    case 'mesRendeVous':
        include ('View/mes_rendez_vous.php');
        break;
    case 'creeProgramme':
        include ('View/cree_programme.php');
        break;
}

?>