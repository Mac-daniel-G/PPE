<?php


// Connexion à la base de données
require_once(__DIR__ . '/../BDD/database.php');
 // Chemin de votre fichier de configuration

// Vérifie si l'utilisateur est connecté
function verifierConnexion() {
    if (!isset($_SESSION['user_role'])) {
        header('Location: connexion.php');
        exit;
    }
}

// Récupère les programmes disponibles
try {
    $query = "
    SELECT * from boutique
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur lors de la récupération des produit : " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FatFitness - Articles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include(__DIR__ .'/../commun/header.php'); ?>

    <div class="container mt-5">
        <h1 class="text-center">Nos Articles</h1>
        <p class="text-center">Faites vos achats</p>

        <div class="row">
    <?php foreach ($articles as $article): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article['nom_article']); ?></h5>
                    <p><img src="<?= htmlspecialchars($article['image_article']); ?>" alt="Image de l'article" style="max-width: 100%; height: auto;"></p>
                    <p class="card-text"><?= htmlspecialchars($article['description_article']); ?></p>
                    <p><strong>Prix :</strong> <?= htmlspecialchars($article['prix_article'] . " " . "$"); ?></p>
                    
                    
                    <?php $isUserLoggedIn = isset($_SESSION['user_role']); ?>
                    <?php if (isset($_SESSION['user_role'])): ?>
                        <form action="View/programmes/panier.php" method="POST">
                            <input type="hidden" name="id_produit" value="<?= htmlspecialchars($article['id_article']); ?>">
                            <input type="hidden" name="id_client" value="<?= htmlspecialchars($_SESSION['user_role']); ?>">
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>

    <?php include(__DIR__ .'/../commun/footer.php'); ?>
</body>
</html>
