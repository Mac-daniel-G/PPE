
<?php
session_start();

session_unset();

session_destroy();

header('Refresh: 2; URL=index.php?page=accueil');
exit();
?>