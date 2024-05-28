<?php
session_start();
$_SESSION['login'] = 'Connexion';
header('Location: app/router/router1.php?action=truc');

?>