<?php
// Inclure les fichiers nécessaires
include_once __DIR__ . '/../commun/header.php';
require_once '../../Controller/ProgrammeController.php';

// Récupérer les programmes spécifiques pour la crossfit
$crossfitProgrammes = ProgrammeController::getProgrammesByType('crossfit');

?>

<div class="container">
    <h1 class="text-center mt-4">Programmes de crossfit</h1>
    <?php if (!empty($crossfitProgrammes)) : ?>
        <div class="row">
            <?php foreach ($crossfitProgrammes as $programme) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../assets/images/crossfit2.jpeg/<?php echo htmlspecialchars($programme['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($programme['titre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($programme['titre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($programme['description']); ?></p>
                            <a href="programmeDetail.php?id=<?php echo htmlspecialchars($programme['id']); ?>" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-center">Aucun programme de crossfit disponible pour le moment.</p>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
