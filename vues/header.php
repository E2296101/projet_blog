<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vues/css/style.css">
    <link rel="stylesheet" href="vues/css/popup.css">
    <script  src="vues/js/popup.js"></script>
    <title>BLOGUE</title>
</head>
<header>
    <h1><a href="index.php">Blogue</a></h1>
    <div class="recherche <?= $visible ?>">
        <form action="index.php">
            <input type="text" placeholder="Recherche..." name="parametre" value="<?= $paramRecherche ?>">
            <input type="submit" name="rechercher" value="Recherche">
            <input type="hidden" name="commande" value="rechercher">
        </form>
    </div>
</header>
<body>
