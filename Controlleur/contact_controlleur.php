<?php
if ($success) {
    header("Location: ../views/contact.php?success=1");
    exit();
} else {
    header("Location: ../views/contact.php?error=1");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Exemple : enregistrer dans la base de données (optionnel)
    // $pdo = new PDO('mysql:host=localhost;dbname=fatfitness_db', 'root', '');
    // $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, message) VALUES (?, ?, ?)");
    // $stmt->execute([$nom, $email, $message]);

    // Exemple : envoyer un email
    $to = 'contact@fatfitness.com';
    $subject = "Message de $nom via le site FatFitness";
    $body = "Nom : $nom\nEmail : $email\n\nMessage :\n$message";
    mail($to, $subject, $body);

    // Redirection après soumission
    header('Location: ../view/accueil.php?message=sent');
    exit;
}
$inscription_newsletter = isset($_POST['newsletter']) ? 1 : 0;

?>