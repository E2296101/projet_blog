
<?php
    if(isset($_SESSION["USER"])){
        $user = $_SESSION["USER"];
        $linkIcon = "vues/icon/login-on.png";
        $lienIdentification = "<a href='index.php?commande=Deconnexion'>Déconnexion</a>";
        $boutonAjouterArticle = "<a class='bouton' href='index.php?commande=FormAjouter'>Ajouter Article</a>";
    }    
    else{
        $user = "Invité"; 
        $linkIcon = "vues/icon/login-off.png";
        $lienIdentification = "<a href='index.php?commande=formAuthentification'>S'identifier</a>";
        $boutonAjouterArticle = "";    
    }
?>
    <div class="popup-conteneur invisible">
      <div class="texte-conteneur">

        <p>
        </p>
      </div>
      <div class="bg"></div>
    </div>
<main>
    <ASIDE>
        <div class="login">
            <img src=<?= $linkIcon ?>  alt="login"> 
            <span><?= $user ?></span>
            <?= $lienIdentification ?>   
        </div>
        <div>
            <?= $boutonAjouterArticle ?>
        </div>
    </ASIDE>
    <div class="conteneur">
        <?php
            if(mysqli_num_rows($resultat_liste_articles) > 0){
                while($ligne = mysqli_fetch_assoc($resultat_liste_articles)){
                echo" <article>
                        <h3>".htmlspecialchars($ligne["titre"])."</h3>
                        <p>".htmlspecialchars($ligne["text"])."</p>
                        <div>
                        <span> Rédigé par : ".htmlspecialchars($ligne["auteur"])."</span>";

                if(isset($_SESSION["USER"])){
                
                        if($_SESSION["USER"] == $ligne["auteur"]){
                        echo"<div><a href='index.php?commande=FormModifier&id=".$ligne["id"]."'>Modifier</a> / 
                                <a href='index.php?commande=Supprimer&id=".$ligne["id"]."'>Supprimer</a></div>";
                        }
                }

                    echo "</div></article>";
                } 
            }
            else{
                echo" <article>
                        <div>
                            <p>
                                <h1> Aucun resultat pour cette recherche! </h1>
                            </P>    
                        </div>
                    </article>";
            }
        ?>
    </div>
</main>
