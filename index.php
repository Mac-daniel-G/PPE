<?php
// Liste des pages autorisées avec leur chemin complet
$allowedPages = [
    'accueil' => __DIR__ . '/View/accueil.php',
    'connexion' => __DIR__ . '/View/connexion.php',
    'inscription' => __DIR__ . '/View/inscription.php',
    'programmes' => __DIR__ . '/View/programmes/index.php',
    'salles' => __DIR__ . '/View/salle.php',
    'mentions_legales' => __DIR__ . '/View/mentions_legales.php',
    'cgu' => __DIR__ . '/View/cgu.php',
    'boutique' => __DIR__ . '/View/boutique.php',
    'contact' => __DIR__ . '/View/contact.php',
    'deconnexion' => __DIR__ . '/View/deconnexion.php',
    'compte' => __DIR__ . '/View/compte.php',
    'mesRendeVous' => __DIR__ . '/View/mes_rendez_vous.php',
    'creeProgramme' => __DIR__ . '/View/cree_programme.php'
];

// Récupérer la page demandée
$page = $_GET['page'] ?? 'accueil';

// Inclure la page si autorisée
if (array_key_exists($page, $allowedPages) && file_exists($allowedPages[$page])) {
    include $allowedPages[$page];
} else {
    // Page non trouvée ou non autorisée : 404
    http_response_code(404);
    echo "Page non trouvée.";
}
?>
