<?php
// Inclure les fichiers nécessaires
include_once '../commun/header.php';
require_once '../../Controller/ProgrammeController.php';

// Récupérer les programmes spécifiques pour la nutrition
$nutritionProgrammes = ProgrammeController::getProgrammesByType('nutrition');

?>

<div class="container">
    <h1 class="text-center mt-4">Conseils Nutritionnels</h1>
    <?php if (!empty($nutritionProgrammes)) : ?>
        <div class="row">
            <?php foreach ($nutritionProgrammes as $programme) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../assets/images/<?php echo htmlspecialchars($programme['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($programme['titre']); ?>">
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
        <p class="text-center">Aucun programme de nutrition disponible pour le moment.</p>
    <?php endif; ?>
</div>

<?php include_once '../commun/footer.php'; ?>
