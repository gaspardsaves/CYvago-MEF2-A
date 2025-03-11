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
    $DOC = file_get_contents('comptes.json');
    $DOC = json_decode($DOC, true);
    $DOC[] = $donnees;
    $DOC = json_encode($DOC, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('comptes.json', $D);
?>