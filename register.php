<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Account erstellen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
if (isset($_POST["submit"])) {
    require("config-dbal.php");
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(array(
            ':username' => $_POST["username"]
        )
    );
    $count = $stmt->rowCount();
    if ($count == 0) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(
            array(
                ':email' => $_POST["email"]
            )
        );
        $count = $stmt->rowCount();
        if ($count == 0) {
            if ($_POST["pw"] == $_POST["pwcheck"]) {
                $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert('user')
                    ->values(
                        array(
                            'email' => '?',
                            'username' => '?',
                            'password' => '?',
                        )
                    )
                    ->setParameter(0, $_POST['email'])
                    ->setParameter(1, $_POST['username'])
                    ->setParameter(2, $_POST['pw'])
                    ->execute();
                echo "Dein Account wurde angelegt";
            } else {
                echo "Die Passwörter stimmen nicht überein!";
            }
        } else {
            echo "Ihre Email ist bereits registriert!";
        }
    } else {
        echo "Der Username ist bereits vergeben!";
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
<h1>Account erstellen</h1>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="text" name="email" placeholder="Email" required><br>
    <input type="password" name="pw" placeholder="Passwort" required><br>
    <input type="password" name="pwcheck" placeholder="Passwort wiederholen" required><br>
    <button type="submit" name="submit">Erstellen</button>
</form>
<br>
<a href="login.php">Hast du bereits einen Account?</a>
</body>
</html>