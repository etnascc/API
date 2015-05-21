<?php
session_start();
$_SESSION['orga'] = $_POST['organisation'];
header('Location: menu.php');
?>