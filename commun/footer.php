<footer class="bg-dark text-light py-4">
    <div class="container">
        <!-- Contact et Coordonnées -->
        <div class="row mb-4">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5>Contactez-nous</h5>
                <form action="../controllers/contact_controller.php" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="4" class="form-control" placeholder="Votre message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
            <div class="col-lg-6 col-md-12">
                <h5>Coordonnées</h5>
                <p>
                    <strong>FatFitness</strong><br>
                    123 Rue de la Santé, Paris, France<br>
                    Téléphone : +33 1 23 45 67 89<br>
                    Email : <a href="mailto:contact@fatfitness.com" class="text-light">contact@fatfitness.com</a>
                </p>
                <h5>Suivez-nous</h5>
                <div class="d-flex">
                    <a href="https://facebook.com" target="_blank" class="me-3" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-light"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="me-3" aria-label="Twitter">
                        <i class="fab fa-twitter text-light"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="me-3" aria-label="Instagram">
                        <i class="fab fa-instagram text-light"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                        <i class="fab fa-linkedin text-light"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Navigation</h5>
                <ul class="list-unstyled">
                    <li><a href="../view/accueil.php" class="text-light">Accueil</a></li>
                    <li><a href="../view/programme.php" class="text-light">Programmes</a></li>
                    <li><a href="../view/salle.php" class="text-light">Salles</a></li>
                    <li><a href="../view/connexion.php" class="text-light">Connexion</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Mentions légales</h5>
                <ul class="list-unstyled">
                    <li><a href="../view/mentions_legales.php" class="text-light">Politique de confidentialité</a></li>
                    <li><a href="../view/cgu.php" class="text-light">Conditions Générales d'Utilisation</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Horaires</h5>
                <p>
                    Lundi - Vendredi : 08h00 - 20h00<br>
                    Samedi : 09h00 - 18h00<br>
                    Dimanche : Fermé
                </p>
            </div>
        </div>

        <hr class="bg-light">
        <!-- Copyright -->
        <div class="text-center">
            <p>&copy; 2024 FatFitness. Tous droits réservés.</p>
        </div>
    </div>
</footer>
