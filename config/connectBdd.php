<?php   
    //connexion à la base de données
    //(à modifier en fonction de votre base de données dans mon cas la bdd l'appele task1)
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=paranges_sos', 'JoanelAdmin','JoanelAdminParanges', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>