<?php
    session_start();
    include 'database.php';
    if(isset($_SESSION["email"])){
        $mail = $_SESSION["email"];
        $commande = $database->prepare("SELECT role FROM users WHERE email=?");
        $commande->bind_param("s", $mail);
        $commande->execute();
        $commande->bind_result($result);
        $commande->fetch();
        $commande->close();
        if($result==(-1)){
            header("Location: bannis.php");
        }
    }
?>