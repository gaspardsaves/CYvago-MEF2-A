<?php

    $PRENOM = $_POST["prenom"];
    $EMAIL = $_POST["mail"];
    $NOM = $_POST["nom"];
    $DATE = $_POST["date"];
    $TEL = $_POST["tel"];
    $MDP = $_POST["mdp"];
    echo $PRENOM;
    echo $NOM;
    echo $EMAIL;
    echo $DATE;
    echo $TEL;
    echo $MDP;
    $donnees["prenom"] = $PRENOM;
    $donnees["nom"] = $NOM;
    $donnees["mail"] = $EMAIL;
    $donnees["date"] = $DATE;
    $donnees["tel"] = $TEL;
    $donnees["mdp"] = password_hash($MDP, PASSWORD_DEFAULT);
    echo $donnees["prenom"];
    echo $donnees["nom"];
    echo $donnees["mail"];
    echo $donnees["date"];
    echo $donnees["tel"];
    echo $donnees["mdp"];
    $data = json_encode($donnees, JSON_UNESCAPED_UNICODE);
    echo $data;
    $Document = fopen("./json/comptes.json", "a+");
    fwrite($Document, $data);
    fclose($Document);
?>