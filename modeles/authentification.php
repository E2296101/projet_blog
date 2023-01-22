<?php

function obtenir_user_id($user){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;
    
    
    //déclarer la requête SQL à exécuter
    $requete = "SELECT * FROM usager WHERE username = ?";

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);   

    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "s", $user);

        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        
        //exécute la requête
        return mysqli_stmt_get_result($reqPrep);
    }
   
}


?>