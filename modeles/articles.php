<?php

function ajouter_article($titre ,$texte, $auteur){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;
    
    //déclarer la requête SQL à exécuter
    $requete = "INSERT INTO article(TITRE,TEXT,AUTEUR) values(?,?,?) ";

    //exécuter avec mysqli_query
    $resultats = mysqli_query($connexion, $requete);

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete); 

    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "sss", $titre,$texte,$auteur);

        //exécute la requête
        mysqli_stmt_execute($reqPrep);

        if(mysqli_stmt_affected_rows($reqPrep) >= 1)
            return true;
        else 
            return false; 
    } 
    else
        return false; 
}

function obtenir_liste_articles(){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;
    
    //déclarer la requête SQL à exécuter
    $requete = "SELECT * FROM article";

    //exécuter avec mysqli_query
    $resultats = mysqli_query($connexion, $requete);

    return $resultats;    
}

function obtenir_liste_articles_recherche($param = ""){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;

    //preparation de parametre de recherche
    $paramRecher =  "%".$param."%";
 
    //déclarer la requête SQL à exécuter
    $requete = "SELECT * FROM article WHERE titre like ? or text like ?";

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete); 
    
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ss", $paramRecher,$paramRecher);

        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        
        //exécute la requête
        return mysqli_stmt_get_result($reqPrep);
    }
   
}

function rechercher_un_article($param = ""){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;


    //déclarer la requête SQL à exécuter
    $requete = "SELECT * FROM article WHERE id =  ? ";

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete); 
    
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "s", $param);

        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        
        //exécute la requête
        return mysqli_stmt_get_result($reqPrep);
    }
   
}

function modifier_article($titre = "",$texte = "",$auteur = "",$id = ""){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;

    //déclarer la requête SQL à exécuter
    $requete = "UPDATE article SET titre = ? , text = ? WHERE auteur = ? && id = ?";

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete); 
    
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ssss", $titre,$texte,$auteur,$id);

        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        
        
        return mysqli_stmt_affected_rows($reqPrep) >= 1 ;
        
    }
    else
        return false;
   
}

function supprimer_article($id = "",$auteur = ""){

    //obtenir la connexion définie dans le modele connexion.php
    global $connexion;

    //déclarer la requête SQL à exécuter
    $requete = "DELETE FROM article WHERE  id = ? && auteur = ?";

    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete); 
    
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ss", $id,$auteur);
  
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        
        
        return mysqli_stmt_affected_rows($reqPrep) >= 1 ;
        
    }
    else
        return false;
   
}


?>