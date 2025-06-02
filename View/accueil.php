<?php 
include_once __DIR__ . '/../commun/header.php'; 
?>

<div class="container mt-5">
    <!-- Bannière d'accueil -->
    <div class="jumbotron text-center bg-light p-5 rounded">
        <h1 class="display-4">Bienvenue chez FatFitness</h1>
        <p class="lead">Votre plateforme idéale pour une santé optimale, adaptée à tous vos objectifs sportifs.</p>

        <?php 
        if (isset($_SESSION['user'])) {
            // Si l'utilisateur est connecté
            echo '<h1>Bienvenue ' . $_SESSION['user']['Nom'] . '</h1>';
        } else {
        }
        ?>

        <a href="index.php?page=programme" class="btn btn-primary btn-lg">Découvrir nos programmes</a>
        
    </div>

    <!-- Section des programmes -->
    <section class="mt-5">
        <h2 class="text-center">Nos Programmes Populaires</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/img/programme/programme1.jpg" class="card-img-top" alt="Programme Cardio">
                    <div class="card-body">
                        <h5 class="card-title">Programme Cardio</h5>
                        <p class="card-text">Boostez votre endurance et brûlez des calories efficacement.</p>
                        <a href="index.php?page=programme" class="btn btn-primary">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/img/programme/crossfit1.webp" class="card-img-top" alt="Programme CrossFit">
                    <div class="card-body">
                        <h5 class="card-title">Programme CrossFit</h5>
                        <p class="card-text">Entraînez tout votre corps avec des mouvements intenses.</p>
                        <a href="index.php?page=programme" class="btn btn-primary">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/img/programme/programme2.jpg" class="card-img-top" alt="Programme Musculation">
                    <div class="card-body">
                        <h5 class="card-title">Programme Musculation</h5>
                        <p class="card-text">Développez votre force et tonifiez vos muscles.</p>
                        <a href="index.php?page=programme" class="btn btn-primary">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des salles -->
    <section class="mt-5">
        <h2 class="text-center">Trouvez une Salle Près de Chez Vous</h2>
        <p class="text-center">Réservez une salle adaptée à vos besoins en quelques clics.</p>
        <div class="text-center">
            <a href="index.php?page=salle" class="btn btn-success btn-lg">Voir les Salles</a>
        </div>
    </section>

    <!-- Section devenir membre -->
    <section class="mt-5 bg-light p-4 rounded">
        <div class="row">
            <div class="col-md-6">
                <h2>Rejoignez la Communauté FatFitness</h2>
                <p>Inscrivez-vous dès aujourd'hui pour bénéficier d'un accompagnement personnalisé par nos coachs.</p>
                <a href="index.php?page=inscription" class="btn btn-primary btn-lg">Créer un Compte</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="assets/img/newlogoFatFitness.svg" alt="Logo FatFitness" class="img-fluid" style="max-width: 60%;">
            </div>
        </div>
    </section>
</div>

<?php 
include_once __DIR__ . '/../commun/footer.php'; 
?>
