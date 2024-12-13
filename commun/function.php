<?php
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function redirectIfNotAuthenticated() {
    if (!isAuthenticated()) {
        header('Location: /View/connexion.php');
        exit;
    }
}
?>

<?php
// Démarrage ou reprise de session
function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Vérifier si un utilisateur est connecté
function isUserLoggedIn() {
    startSession();
    return isset($_SESSION['user_id']);
}

// Récupérer les informations de l'utilisateur connecté
function getLoggedInUser() {
    startSession();
    return isUserLoggedIn() ? $_SESSION : null;
}

// Rediriger si l'utilisateur n'est pas connecté
function redirectIfNotLoggedIn($redirectUrl = 'connexion.php') {
    if (!isUserLoggedIn()) {
        header("Location: $redirectUrl");
        exit;
    }
}

// Déconnexion de l'utilisateur
function logoutUser() {
    startSession();
    session_unset();
    session_destroy();
}

// Exemple d'ajout d'utilisateur dans la session
function loginUser($userId, $userRole) {
    startSession();
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_role'] = $userRole;
}
?>
