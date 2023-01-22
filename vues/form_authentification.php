
<div class="box-identification">
        <img class="icon-login"  src="vues/icon/login.png" alt="login">
        <form action="index.php" method="post" class="identification">
            <input type="text" name="user" placeholder="Utilisateur" value="<?= $nomutilisateur ?>" >
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="submit" name="authentification" value="S'identifier">
            <input type="hidden" name="commande" value="authentification">
            <small><?= $message ?></small>
        </form>
</div>