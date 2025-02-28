<?php
$dbConfig = parse_ini_file(".env");

define('DB_HOST', $dbConfig["DB_HOST"]);
define('DB_USER', $dbConfig["DB_USER"]);
define('DB_PASS', $dbConfig["DB_PASS"]);
define('DB_NAME', $dbConfig["DB_NAME"]);
?>