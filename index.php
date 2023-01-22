
<?php

    //démarrage OU récupération de la session
    session_start(); 

    //variable pour afficher la zone de recherche
    $visible = "";
    //variable pour remplir la zone de recherche
    $paramRecherche = "";

    // message erreur
    $message = "";

    // nom utilisateur
    $nomutilisateur = "";
    $idArticle = "";
    $titreArticle = "";
    $textArticle = "";
    $actionBouton = "";
    


    if(isset($_REQUEST["commande"]))
    {
        $commande = $_REQUEST["commande"];
    }
    else 
    {
        //assignation de la commande par défaut -- page liste des articles
        $commande = "ListeArticles";
    }

    //inclure le modele de connexion
    require_once("modeles/connexion.php");

    //inclure le modele d'affichage des vues
    require_once("modeles/affichageVues.php");

    //inclure le modele  Articles
    require_once("modeles/articles.php");

    // recuperation de la liste de tous les articles
    $resultat_liste_articles = obtenir_liste_articles();    

    switch ($commande) {
        case "ListeArticles":
            echo '<script>afficherConfirmation("aj");</script>';
            
            //affichage des vues 
            vueArticles($resultat_liste_articles,$paramRecherche,$visible);

            break;

        case "formAuthentification":

            // vérifier si dèja connecté
            if(!isset($_SESSION["USER"])){

                $visible = "invisible";
                //affichage
                vueAthentification($nomutilisateur,$message,$visible);
            }
            else{
                //affichage
                vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }
            

            break;
        
        case "authentification":
           
                if(isset($_REQUEST["user"] , $_REQUEST["password"])){

                    $verificationSaisie =  ((trim($_REQUEST["user"]) == "") || (trim($_REQUEST["password"]) == ""));
                    
                    if($verificationSaisie){
                        $visible = "invisible";
                        $message = "*Veuillez bien remplir les champs correctement !";

                        //affichage
                        vueAthentification($nomutilisateur,$message,$visible);                
                    }
                    else{
                        //inclure le modele pour l authentification
                        require_once("modeles/authentification.php");
                        $resultat_recherche = obtenir_user_id(trim($_REQUEST["user"])); 
                        $nbLignesRecherche = mysqli_num_rows($resultat_recherche);
                        if($nbLignesRecherche == 0){
                            $visible = "invisible";
                            $message = "*Erreur d'authentification !";
                            $nomutilisateur = trim($_REQUEST["user"]);

                            //affichage 
                            vueAthentification($nomutilisateur,$message,$visible); 
                        }
                        else{

                            $user = mysqli_fetch_assoc($resultat_recherche);

                            if($user["password"] == password_verify(trim($_REQUEST["password"]),$user["password"])){
                                
                                $_SESSION["USER"] = $user["username"];

                                //affichage
                                vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                            }
                            else{

                                $visible = "invisible";
                                $message = "*Erreur d'authentification !";
                                $nomutilisateur = trim($_REQUEST["user"]);
                              
                                //affichage 
                                vueAthentification($nomutilisateur,$message,$visible); 
                            }
                        }
                    }
                }
                
            
            break;

        case "rechercher":

            if(isset($_REQUEST["rechercher"],$_REQUEST["parametre"]) && trim($_REQUEST["parametre"]) != "" ){

                $paramRecherche = trim($_REQUEST["parametre"]);

                // recuperation de la liste de tous les articles
                $resultat_liste_articles = obtenir_liste_articles_recherche(trim($_REQUEST["parametre"])); 
            }

            //affichage des vues 
            vueArticles($resultat_liste_articles,$paramRecherche,$visible);

            break;

        case "FormAjouter":

            if(isset($_SESSION["USER"])){  
                $visible = "invisible";
                $actionBouton = "Ajouter";
                //affichage
                vueFormModifAjout($message,$visible,$actionBouton,$idArticle,$titreArticle,$textArticle);
            }
            else{
                vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }

            break;

        case "Ajouter":
            if(isset($_SESSION["USER"])){ // protectiondu formulaire
                if(isset($_REQUEST["titre"],$_REQUEST["texte"]) && (trim($_REQUEST["titre"]) != "" && trim($_REQUEST["texte"]) != "" )){

                   if(ajouter_article(trim($_REQUEST["titre"]),trim($_REQUEST["texte"]),$_SESSION["USER"])){

                        // recuperation de la liste de tous les articles
                         $resultat_liste_articles = obtenir_liste_articles(); 

                         vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                        echo '<script>afficherConfirmation("aj");</script>'; // affichage message confirmation
                    }

                }
                else{
                    $visible = "invisible";
                    $titreArticle = $_REQUEST["titre"];
                    $textArticle = $_REQUEST["texte"];
                    $actionBouton = "Ajouter";
                    $message = "*Merci de bien saisir les informations!";
                    //affichage
                    vueFormModifAjout($message,$visible,$actionBouton,$idArticle,$titreArticle,$textArticle);
                }
            }
            else{
                //affichage 
                vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }

            break;

            case "FormModifier":

                if(isset($_SESSION["USER"])){ // protectiondu formulaire
                    if(isset($_REQUEST["id"]) && trim($_REQUEST["id"]) != ""){
                        $resultat_recherche = rechercher_un_article($_REQUEST["id"]);
                        $nbLignesRecherche = mysqli_num_rows($resultat_recherche);
                        if($nbLignesRecherche > 0){
                            $article = mysqli_fetch_assoc($resultat_recherche);
                            if($_SESSION["USER"] == $article["auteur"] ){ // protection contre la modification par un utilisateur non propritaire
                                $visible = "invisible";
                                $idArticle = $article["id"];
                                $titreArticle = $article["titre"];
                                $textArticle  = $article["text"];
                                $actionBouton = "Modifier";
                                $message = "";
                                //affichage
                                vueFormModifAjout($message,$visible,$actionBouton,$idArticle,$titreArticle,$textArticle);
                            }
                            else
                                //affichage 
                                vueArticles($resultat_liste_articles,$paramRecherche,$visible); 
                        }
                        else  
                            //affichage 
                            vueArticles($resultat_liste_articles,$paramRecherche,$visible); 
                    }                      
                    else
                        //affichage 
                        vueArticles($resultat_liste_articles,$paramRecherche,$visible);

                }
                else{
                    //affichage 
                    vueArticles($resultat_liste_articles,$paramRecherche,$visible);                   
                }
                

                break;
        case "Modifier":

            if(isset($_SESSION["USER"])){ // protectiondu formulaire
                if(isset($_REQUEST["titre"],$_REQUEST["texte"]) && (trim($_REQUEST["titre"]) != "" && trim($_REQUEST["texte"]) != "" )){

                   if(modifier_article(trim($_REQUEST["titre"]),trim($_REQUEST["texte"]),$_SESSION["USER"],$_REQUEST["id"])){
                        // recuperation de la liste de tous les articles
                         $resultat_liste_articles = obtenir_liste_articles(); 
                        //Affichage
                        vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                        echo '<script>afficherConfirmation("md");</script>'; // affichage message confirmation
                    }
                    else{
                        vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                        echo '<script>afficherConfirmation("echec");</script>'; // affichage message confirmation
                    }

                }
                else{
                    $visible = "invisible";
                    $idArticle = $_REQUEST["id"];
                    $titreArticle = $_REQUEST["titre"];
                    $textArticle = $_REQUEST["texte"];
                    $actionBouton = "Modifier";
                    $message = "*Merci de bien saisir les informations!";
                    //affichage
                    vueFormModifAjout($message,$visible,$actionBouton,$idArticle,$titreArticle,$textArticle);
                }
            }
            else{
                //affichage 
                vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }

            break;

        case "Supprimer":

            if(isset($_SESSION["USER"])){ // protectiondu formulaire
                if(isset($_REQUEST["id"]) && trim($_REQUEST["id"]) ){
                    if(supprimer_article($_REQUEST["id"],$_SESSION["USER"])){
                        // recuperation de la liste de tous les articles
                        $resultat_liste_articles = obtenir_liste_articles(); 
                        //Affichage
                         vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                        echo '<script>afficherConfirmation("sp");</script>'; // affichage message confirmation
                    }
                    else{
                         vueArticles($resultat_liste_articles,$paramRecherche,$visible);
                        echo '<script>afficherConfirmation("echec");</script>'; // affichage message erreur
                    }
                }
                else
                     vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }
            else{
                //affichage 
                 vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            }            

            break;

        case "Deconnexion":

            unset($_SESSION["USER"]) ;

            //affichage 
             vueArticles($resultat_liste_articles,$paramRecherche,$visible);
            break;

        default:
            header("Location: index.php");
            die();
            
    }

?>