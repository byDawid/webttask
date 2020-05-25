<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Abmelden</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <nav class="menu">
        <ul class="links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
        <div>
            <input type="search" id="suche" placeholder="Search">
            <button class="searchButton" type="button">Search</button>
        </div>
    </nav>
</header>
<h1>Abmelden</h1>
<a href="logout.php">Abmelden</a>
</body>
</html>