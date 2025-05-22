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
        include ('view/programmes/index.php');
        break;
    case 'salle':
        include ('view/salle.php');
        break;
    case 'inscription':
        include ('view/inscription.php');
        break;
    case 'connexion':
        include ('view/connexion.php');
        break;
    case 'mentions_legales':
        include ('view/mentions_legales.php');
        break;
    case 'cgu':
        include ('view/cgu.php');
        break;
    case 'boutique':
        include ('view/boutique.php');
        break;
    case 'contact':
        include ('view/contact.php');
        break;
    case 'deconnexion':
        include ('view/deconnexion.php');
        break;
    case 'compte':
        include ('view/compte.php');
        break;
    case 'mesRendeVous':
        include ('view/mes_rendez_vous.php');
        break;
    case 'creeProgramme':
        include ('view/cree_programme.php');
        break;
}

?>