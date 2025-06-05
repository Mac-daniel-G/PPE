<?php
// Liste des pages autorisées avec leur chemin relatif
$allowedPages = [
    'accueil' => 'View/accueil.php',
    'connexion' => 'View/connexion.php',
    'inscription' => 'View/inscription.php',
    'programmes' => 'View/programmes/index.php',
    'salles' => 'View/salle.php',
    'mentions_legales' => 'View/mentions_legales.php',
    'cgu' => 'View/cgu.php',
    'boutique' => 'View/boutique.php',
    'contact' => 'View/contact.php',
    'deconnexion' => 'View/deconnexion.php',
    'compte' => 'View/compte.php',
    'mesRendeVous' => 'View/mes_rendez_vous.php',
    'creeProgramme' => 'View/cree_programme.php',
];

// Récupérer la page demandée, par défaut 'accueil'
$page = $_GET['page'] ?? 'accueil';

// Sécuriser la page demandée (existe dans la liste autorisée)
if (array_key_exists($page, $allowedPages)) {
    $filePath = __DIR__ . '/' . $allowedPages[$page];

    if (file_exists($filePath)) {
        include $filePath;
    } else {
        http_response_code(404);
        echo "Page non trouvée.";
    }
} else {
    http_response_code(404);
    echo "Page non autorisée.";
}
?>
