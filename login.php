<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
if (isset($_POST["submit"])) {
    require("config-dbal.php");
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(array(
        ':username' => $_POST["username"]
    ));
    $count = $stmt->rowCount();
    if ($count == 1) {
        $row = $stmt->fetch();
        if (password_verify($_POST["pw"], $row["password"])) {
            session_start();
            $_SESSION["username"] = $row["username"];
            header("Location: logged-in.php");
        } else {
            echo "Der Login ist fehlgeschlagen: Ihr User ist entweder nicht registriert oder ihr Passwort bzw. ihre E-Mail sind falsch!";
        }
    } else {
        echo "Der Login ist fehlgeschlagen: Ihr User ist entweder nicht registriert oder ihr Passwort bzw. ihre E-Mail sind falsch!";
    }
}
?>
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
<h1>Anmelden</h1>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="pw" placeholder="Passwort" required><br>
    <button type="submit" name="submit">Einloggen</button>
</form>
<br>
<a class="sublink" href="register.php">Noch keinen Account?</a><br>
<a class="sublink" href="#">Hast du dein Passwort vergessen?</a>
</body>
</html>