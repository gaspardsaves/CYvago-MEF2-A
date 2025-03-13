<?php

    $PRENOM = $_POST["prenom"];
    $EMAIL = $_POST["mail"];
    $NOM = $_POST["nom"];
    $DATE = $_POST["date"];
    $TEL = $_POST["tel"];
    echo $PRENOM;
    echo $NOM;
    echo $EMAIL;
    echo $DATE;
    echo $TEL;
    $donnees["prenom"] = $PRENOM;
    $donnees["nom"] = $NOM;
    $donnees["mail"] = $EMAIL;
    $donnees["date"] = $DATE;
    $donnees["tel"] = $TEL;
    echo $donnees["prenom"];
    echo $donnees["nom"];
    echo $donnees["mail"];
    echo $donnees["date"];
    echo $donnees["tel"];
    $data = json_encode($donnees, JSON_PRETTY_PRINT);
    echo $data;
    $Document = fopen("comptes.json", "w");
    fwrite($Document, $data);
    fclose($Document);
    /*$Document = $fopen("comptes.json", "a+");
    $data = json_encode($donnees);
    file_put_contents($Document, $data);
    fclose($Document);
    /*
    class Account {
        private $nom;
        private $prenom;
        private $mail;
        private $date;
        private $tel;
        private $storage = "data.json";

    }*/
?>