<?php
require_once(__DIR__ . '/../BDD/database.php'); // Connexion à la base de données

// Initialisation des variables
$filtre = '';
$salles = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    // Récupérer la valeur du filtre (recherche)
    $filtre = trim($_GET['search']);

    // Requête pour filtrer les salles par ville ou chaîne
    $query = "
    SELECT * FROM salles
    WHERE ville LIKE :filtre OR chaine LIKE :filtre";
    
    // Préparation de la requête et exécution
    $stmt = $pdo->prepare($query);
    $stmt->execute(['filtre' => '%' . $filtre . '%']);
} else {
    // Si pas de recherche, on récupère toutes les salles
    $query = "SELECT * FROM salles";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}

$salles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FatFitness - Salles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php include(__DIR__ . '/../commun/header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center">Nos Salles</h1>
    <p class="text-center">Recherchez une salle par ville ou chaîne</p>

    <!-- Formulaire de recherche -->
    <form method="get" action="salle.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par ville ou chaîne..." value="<?= htmlspecialchars($filtre) ?>">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <div class="row">
        <?php if ($salles): ?>
            <?php foreach ($salles as $salle): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($salle['nom']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($salle['adresse']); ?></p>
                            <p><strong>Ville :</strong> <?= htmlspecialchars($salle['ville']); ?></p>
                            <p><strong>Chaîne :</strong> <?= htmlspecialchars($salle['chaine']); ?></p>
                            <p><strong>Heure d'ouverture :</strong> <?= htmlspecialchars($salle['horaire_debut']); ?></p>
                            <p><strong>Heure de fermeture :</strong> <?= htmlspecialchars($salle['horaire_fin']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Aucune salle trouvée pour votre recherche.</p>
        <?php endif; ?>
    </div>
</div>

<?php include(__DIR__ . '/../commun/footer.php'); ?>
</body>
</html>
