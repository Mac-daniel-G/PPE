<?php
session_start();

// Vérifie si l'utilisateur est connecté
function verifierConnexion() {
    if (!isset($_SESSION['utilisateur'])) {
        header('Location: connexion.php');
        exit;
    }
}
?>