<?php
include_once __DIR__ . '/../commun/header.php';
require_once __DIR__ . '/../BDD/database.php';

// Vérifie que l'utilisateur est un coach connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Coach') {
    header('Location: ../pages/connexion.php');
    exit();
}

$id_coach = $_SESSION['user_id'];

// Traitement de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id_reservation = ?");
    $stmt->execute([$delete_id]);
    $message = "Réservation supprimée avec succès.";
}

// Récupérer les réservations liées au coach
$stmt = $pdo->prepare("
    SELECT r.id_reservation, r.date_reservation,
           s.Nom AS nom_sportif, s.Prenom AS prenom_sportif,
           p.nom_programme
    FROM reservations r
    JOIN programme p ON r.programme_id = p.id_programme
    JOIN sportif s ON r.sportif_id = s.Id_Sportif
    WHERE p.id_coach = ?
    ORDER BY r.date_reservation DESC
");

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <h2 class="mb-4">Mes Rendez-vous</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (count($reservations) > 0): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Programme</th>
                    <th>Sportif</th>
                    <th>Date de réservation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?= htmlspecialchars($res['nom_programme']) ?></td>
                        <td><?= htmlspecialchars($res['prenom_sportif'] . ' ' . $res['nom_sportif']) ?></td>
                        <td><?= htmlspecialchars($res['date_reservation']) ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réservation ?');">
                                <input type="hidden" name="delete_id" value="<?= $res['id_reservation'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune réservation liée à vos programmes pour le moment.</p>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
