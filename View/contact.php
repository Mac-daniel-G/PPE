<?php 
include_once __DIR__ . '/../commun/header.php';
?>

<!-- Contact et Coordonnées -->
<div class="row mb-4">
    <div class="jumbotron text-center bg-light p-5 mb-4 rounded">
        <h5 class="fw-bold text-primary">Contactez-nous</h5>
        <p class="mb-4 text-muted">Vous avez une question, une demande spécifique ou souhaitez simplement entrer en contact avec notre équipe ? Nous sommes à votre écoute ! Veuillez remplir le formulaire ci-dessous avec le plus de détails possible afin que nous puissions vous répondre rapidement et efficacement. Notre équipe s’engage à revenir vers vous dans les plus brefs délais.</p>


        <!-- Messages de confirmation ou d'erreur -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                Votre message a bien été envoyé. Nous vous répondrons bientôt !
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Une erreur est survenue. Veuillez réessayer.
            </div>
        <?php endif; ?>

        <form action="../controlleur/contact_controller.php" method="POST" novalidate>
            <div class="form-floating mb-3">
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom" required>
                <label for="nom">Nom</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <textarea name="message" id="message" class="form-control" placeholder="Votre message" required style="height: 120px;"></textarea>
                <label for="message">Message</label>
            </div>

            <div class="form-check mb-4 text-start">
                <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter">
                <label class="form-check-label" for="newsletter">
                    Je souhaite recevoir des offres exclusives, des conseils bien-être et les dernières nouvelles de FatFitness par email.
                </label>
            </div>


            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
<?php include_once __DIR__ . '/../commun/footer.php'; ?>
