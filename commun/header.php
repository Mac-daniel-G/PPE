<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FatFitness - Votre plateforme de fitness en ligne. Découvrez nos programmes, nos coachs et nos salles !">
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>FatFitness</title>
</head>
<body>
    <!-- Barre de navigation Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <!-- Logo et titre -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="../assets/img/logo.svg" alt="Logo FatFitness" width="40" height="40" class="me-2">
                <span>FatFitness</span>
            </a>
            <!-- Bouton pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Liens de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="accueil.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=programme">Programmes</a></li>
                    <li class="nav-item"><a class="nav-link" href="salle.php">Salles</a></li>
                    <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
