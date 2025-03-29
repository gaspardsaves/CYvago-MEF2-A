<?php
    //Si vous n'êtes pas sur ma machine changer les coordonnées de connexion à phpmyadmin
    $user = "root";
    $server = "localhost";
    $password = "";
    $DB = "zanimotrip";
    $database = new mysqli($server, $user, $password, $DB);
    if ($database->connect_error) {
        die("Erreur de connexion: " . $database->connect_error);
    }
    return $database;
?>