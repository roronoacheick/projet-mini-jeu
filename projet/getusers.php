<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
} catch (PDOException $e) {
    die("Can't connect to " . DB_NAME . ": " . $e->getMessage());
}

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["age"])) {
    
    $mail = filter_var(trim($_POST["mail"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    $age = trim($_POST["age"]);

    if (filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($password) && !empty($age)) {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if user already exists
        $checkUser = $pdo->prepare('SELECT mail FROM users WHERE mail = :mail');
        $checkUser->bindParam(':mail', $mail, PDO::PARAM_STR);
        $checkUser->execute();
        
        if ($checkUser->rowCount() > 0) {
            echo "This email is already registered.";
        } else {
            $request = $pdo->prepare('INSERT INTO users (mail, password, age) VALUES (:mail, :password, :age)');
            $request->bindParam(':mail', $mail, PDO::PARAM_STR);
            $request->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $request->bindParam(':age', $age, PDO::PARAM_STR);

            $success = $request->execute();

            if ($success) {
                echo "Registration successful!";
            } else {
                echo "Error during registration.";
            }
        }
    } else {
        echo "Invalid data.";
    }
} else {
    echo "Please provide all required parameters.";
}

$pdo = null;
?>