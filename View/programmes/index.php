<?php


// Connexion à la base de données
require_once(__DIR__ . '/../../BDD/database.php');
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
    SELECT p.*, 
           c.Nom AS nom_coach, 
           c.Prenom AS prenom_coach,
           s.nom AS nom_salle
    FROM programme p
    LEFT JOIN Coach c ON p.coach_id = c.Id_Coach
    LEFT JOIN salles s ON p.salle_id = s.id
";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur lors de la récupération des programmes : " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FatFitness - Programmes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include(__DIR__ .'/../../commun/header.php'); ?>

    <div class="container mt-5">
        <h1 class="text-center">Nos Programmes</h1>
        <p class="text-center">Choisissez un programme adapté à vos besoins et commencez dès aujourd'hui !</p>

        <div class="row">
    <?php foreach ($programmes as $programme): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($programme['nom_programme']); ?></h5>
                    <p class="card-text"><?= htmlspecialchars($programme['description']); ?></p>
                    <p><strong>Durée :</strong> <?= htmlspecialchars($programme['duree']); ?></p>
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($programme['categorie']); ?></p>
                    <p><strong>Coach :</strong> <?= htmlspecialchars($programme['nom_coach'] . ' ' . $programme['prenom_coach']); ?></p>
                    <p><strong>Salle :</strong> <?= htmlspecialchars($programme['nom_salle']); ?></p>
                    
                    
                    <?php $isUserLoggedIn = isset($_SESSION['user_role']); ?>
                    <?php if (isset($_SESSION['user_role'])): ?>
                        <form action="View/programmes/start_programme.php" method="POST">
                            <input type="hidden" name="programme_id" value="<?= htmlspecialchars($programme['id_programme']); ?>">
                            <input type="hidden" name="sportif_id" value="<?= htmlspecialchars($_SESSION['user_role']); ?>">
                            <button type="submit" class="btn btn-primary">Commencer</button>
                        </form>
                    <?php else: ?>
                        <a href="../View/connexion.php" class="btn btn-secondary">Connectez-vous pour suivre ce programme</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>

    <?php include(__DIR__ .'/../../commun/footer.php'); ?>
</body>
</html>
