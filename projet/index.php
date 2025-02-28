<?php
require_once 'config.php';

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );

    echo "Successfully connected to database";
} catch (PDOException $e) {
    die("Can't connect to " . DB_NAME . ": " . $e->getMessage());
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration page</title>
    <link rel="stylesheet" href="registration.css" />
  </head>
  <body>
    <div class="base"></div>
    <form method="post" action="getusers.php">
      <div class="e-mail">
        <input type="email" name="mail" required placeholder="e-mail" />
      </div>
      
      <div class="password">
        <input type="password" name="password" required placeholder="Mot de passe" />
      </div>
      <div class="age">
        <input type="date" name="age" required placeholder="jj/mm/aaaa" />
      </div>
      <button type="submit">S'inscrire</button>
    </form>

    <div class="blue_band"></div>
    <div class="Marvel_Logo_SM"></div>
    <div class="spiderweb_arc"></div>
    <div class="Spiderman4_movie"></div>
    <script src="registration.js"></script>
  </body>
</html>