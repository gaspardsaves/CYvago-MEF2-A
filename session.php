<?php
    session_start();
    if(isset($_SESSION["mail"])){
        echo $_SESSION["mail"];
    } 
?>