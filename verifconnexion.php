<?php
    $doc = fopen('./json/comptes.json', 'r+');     
    $Condition = 0;
    $lectureJSON = json_decode(file_get_contents($doc), true);
    foreach ($lectureJSON as $contenu){
    if(($contenu["mail"]==$_POST["AdresseMail"]) /*&& (password_verify($_POST["MotDePasse"], $contenu["mdp"]))*/){
        $Condition = 1;
        }
    }
    if($Condition==1){
        echo "OK";
    }
    else{
        echo "PAS OK";
    }
    fclose($doc);
        ?>