<?php
session_start();
$_SESSION['login'] = 'vide';
$_SESSION['role'] = -1;
header('Location: app/router/router1.php?action=truc');
?>