<?php
    include 'config.php';
    $database = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    if ($database->connect_error) {
        die("Erreur de connexion: " . $database->connect_error);
    }
    return $database;
?>