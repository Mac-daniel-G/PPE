<?php
include_once __DIR__ . '/../commun/header.php';
require_once(__DIR__ . '/../BDD/database.php');


// Traitement du formulaire de création
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_programme = $_POST['nom_programme'];
    $rythme = $_POST['rythme'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];
    $categorie = $_POST['categorie'];
    $salle_id = !empty($_POST['salle_id']) ? $_POST['salle_id'] : null;

    try {
        $stmt = $pdo->prepare("INSERT INTO programme (nom_programme, rythme, description, duree, categorie, salle_id, coach_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom_programme, $rythme, $description, $duree, $categorie, $salle_id, $idCoach]);
        $message = "Programme créé avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}

// Récupérer les programmes du coach
$programmes = $pdo->prepare("SELECT * FROM programme WHERE coach_id = ?");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Programme - FatFitness</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="jumbotron text-center bg-light p-5 mb-4 rounded">
        <h1>Bonjour Coach <?= htmlspecialchars($coach['Prenom']) ?> <?= htmlspecialchars($coach['Nom']) ?> !</h1>
        <p>Vous êtes un coach particulier chez FatFitness spécialisé en <strong><?= htmlspecialchars($coach['Specialite']) ?></strong>. Merci de votre engagement 💪</p>

        <h2>Créer un nouveau programme</h2>
        <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>

        <form method="post" action="">
            <label>Nom du programme : <input type="text" name="nom_programme" required></label><br><br>
            <label>Rythme : <input type="text" name="rythme" required></label><br><br>
            <label>Description : <textarea name="description" required></textarea></label><br><br>
            <label>Durée (hh:mm:ss) : <input type="time" name="duree" step="1" required></label><br><br>
            <label>Catégorie :
                <select name="categorie" required>
                    <option value="simple">Simple</option>
                    <option value="moyen">Moyen</option>
                    <option value="lourd">Lourd</option>
                </select>
            </label><br><br>
            <label>ID Salle (optionnel) : <input type="number" name="salle_id"></label><br><br>
            <button type="submit">Créer le programme</button>
        </form>

        <h2>Vos programmes enregistrés</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Rythme</th>
                    <th>Description</th>
                    <th>Durée</th>
                    <th>Catégorie</th>
                    <th>ID Salle</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $programmes->fetch()): ?>
                    <tr>
                        <td><?= $row['id_programme'] ?></td>
                        <td><?= htmlspecialchars($row['nom_programme']) ?></td>
                        <td><?= htmlspecialchars($row['rythme']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= $row['duree'] ?></td>
                        <td><?= $row['categorie'] ?></td>
                        <td><?= $row['salle_id'] ?? '—' ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
    </div>
</body>

</html>
<?php include_once __DIR__ . '/../commun/footer.php'; ?>
