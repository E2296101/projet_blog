<?php

function vueArticles($resultat_liste_articles,$paramRecherche,$visible){
    require_once("vues/header.php");
    require("vues/liste_article.php");
    require_once("vues/footer.html");
}

function vueAthentification($nomutilisateur,$message,$visible){
    //affichage des vues 
    require_once("vues/header.php");
    require("vues/form_authentification.php");
    require_once("vues/footer.html");
}

function vueFormModifAjout($message,$visible,$actionBouton,$idArticle,$titreArticle,$textArticle){
    require("vues/header.php");
    require("vues/form_modif_ajout.php");
    require_once("vues/footer.html");
}

?>