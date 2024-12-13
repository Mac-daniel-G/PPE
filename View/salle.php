<?php
include_once __DIR__ . '/../commun/header.php';
require_once('../Model/salleModel.php'); // Modèle pour gérer les données des salles

// Instanciation du modèle
$salleModel = new SalleModel();

try {
    $salles = $salleModel->searchSalles();

    echo "<h1>Liste des salles</h1>";
    echo "<ul>";
    foreach ($salles as $salle) {
        echo "<li>" . htmlspecialchars($salle['nom']) . "</li>";
    }
    echo "</ul>";
} catch (Exception $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
}

// $salleModel = new SalleModel(BaseModel::getConnection());
// $salles = $salleModel->searchSalles();

if ($salles) {
    foreach ($salles as $salle) {
        echo $salle['nom']; // or any other property you want to display
    }
} else {
    echo "Aucune salle trouvée.";
}

// Vérification de la recherche
$search = $_GET['search'] ?? '';
$salles = SalleModel::searchSalles($search);
?>

<div class="container mt-5">
    <h1 class="text-center">Salles de Sport</h1>
    <p class="text-center">Recherchez et réservez une salle de sport près de chez vous.</p>

    <!-- Barre de recherche -->
    <form class="mb-4" method="get" action="salle.php">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Rechercher une salle, une ville ou une chaîne" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    <!-- Liste des salles -->
    <?php if (!empty($salles)) : ?>
        <div class="row">
            <?php foreach ($salles as $salle) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($salle['nom']) ?></h5>
                            <p class="card-text">
                                <strong>Adresse :</strong> <?= htmlspecialchars($salle['adresse']) ?><br>
                                <strong>Ville :</strong> <?= htmlspecialchars($salle['ville']) ?><br>
                                <strong>Chaine :</strong> <?= htmlspecialchars($salle['chaine']) ?>
                            </p>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reservationModal">
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-center text-muted">Aucune salle ne correspond à votre recherche.</p>
    <?php endif; ?>
</div>

<!-- Modal de réservation -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="reservation_handler.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Réserver une salle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="salle_id" id="salleIdInput">
                    <div class="mb-3">
                        <label for="salleNomInput" class="form-label">Salle</label>
                        <input type="text" class="form-control" id="salleNomInput" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="clientNom" class="form-label">Votre nom</label>
                        <input type="text" class="form-control" id="clientNom" name="client_nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientEmail" class="form-label">Votre email</label>
                        <input type="email" class="form-control" id="clientEmail" name="client_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateReservation" class="form-label">Date de réservation</label>
                        <input type="date" class="form-control" id="dateReservation" name="date_reservation" required>
                    </div>
                    <div class="mb-3">
                        <label for="horaireReservation" class="form-label">Horaire</label>
                        <input type="time" class="form-control" id="horaireReservation" name="horaire" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script pour remplir les champs du modal -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reservationModal = document.getElementById('reservationModal');
        reservationModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const salleId = button.getAttribute('data-salle-id');
            const salleNom = button.getAttribute('data-salle-nom');

            document.getElementById('salleIdInput').value = salleId;
            document.getElementById('salleNomInput').value = salleNom;
        });
    });
</script>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>