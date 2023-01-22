<?php
    //parametres connexion WEBDEV
    /*define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "ligue");*/

    //parametres connexion locale
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "blog");

    function connectDB()
    {
        //se connecter à la base de données
        $connexion = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);

        if(!$connexion)
            die("Erreur de connexion. MySQLi : " . mysqli_connect_error());

        //s'assurer que la connexion traite le UTF8
        mysqli_query($connexion, "SET NAMES 'utf8'");

        return $connexion;
    }

    $connexion = connectDB();

?>