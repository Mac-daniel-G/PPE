<?php 
include_once __DIR__ . '/../commun/header.php';
require_once __DIR__ . '/../BDD/database.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
    header("Location: connexion.php");
    exit();
}

$user_id   = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

// Récupération des infos utilisateur
$stmt = $pdo->prepare(
    $user_role === 'sportif' ? 
    "SELECT * FROM sportif WHERE Id_sportif = ?" : 
    "SELECT * FROM coach WHERE Id_coach = ?"
);
$stmt->execute([$user_id]);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// Réservations (si sportif)
$reservations = [];
if ($user_role === 'sportif') {
    $stmt = $pdo->prepare("
        SELECT r.date_reservation, p.nom_programme, p.description 
        FROM reservations r
        JOIN programme p ON r.programme_id = p.id_programme
        WHERE r.sportif_id = ?
        ORDER BY r.date_reservation DESC
    ");
    $stmt->execute([$user_id]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="jumbotron text-center bg-light p-5 mb-4 rounded">
        <h1 class="display-5">Bienvenue <?= htmlspecialchars($user_info['Nom'] . ' ' . $user_info['Prenom']) ?></h1>
        <p class="lead">Votre espace personnel dédié à votre bien-être sportif.</p>
        <?php if ($_SESSION['user_role'] === 'coach'): ?>
            <a href="index.php?page=creeProgramme" class="btn btn-primary mt-3">Créer ton programme</a>
        <?php else: ?>
            <a href="index.php?page=programme" class="btn btn-primary mt-3">Découvrir nos programmes</a>
        <?php endif; ?>
        
    </div>

    <div class="jumbotron text-center bg-light p-5 mb-4 rounded">
        <div class="profile-card">
            <h1 class="mb-3">Mon Compte</h1>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user_info['Nom'] . ' ' . $user_info['Prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user_info['Email']) ?></p>
            <p><strong>Rôle :</strong> <?= htmlspecialchars($user_role) ?></p>
        </div>

        <?php if ($user_role === 'sportif'): ?>
            <div class="profile-card">
                <h2 class="mb-3">Mes Réservations</h2>
                <?php if (!empty($reservations)): ?>
                    <ul class="reservation-list">
                        <?php foreach ($reservations as $res): ?>
                            <li>
                                <strong><?= htmlspecialchars($res['nom_programme']) ?></strong><br>
                                <?= htmlspecialchars($res['description']) ?><br>
                                <small class="text-muted">Réservé le : <?= htmlspecialchars($res['date_reservation']) ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Aucune réservation trouvée.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="profile-card">
                <p class="text-muted">Les coachs n'ont pas de réservations affichées.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
