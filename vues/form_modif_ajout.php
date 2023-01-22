<div class="modif-ajout">
    <fieldset> 
    <legend><?= $actionBouton ?> article</legend>
        <form action="index.php" method="get">
            <input type="hidden" name="id" value="<?= $idArticle ?>">
            <input type="text" name="titre" placeholder="Titre de l'article..." value="<?= $titreArticle ?>" >
            <textarea name="texte" cols="30" rows="10" placeholder="Texte de l'article..."><?= $textArticle ?></textarea>
            <input type="submit" name="commande" value="<?= $actionBouton ?>">
            <small><?= $message ?></small>
        </form>
    </fieldset>
</div>

        
    