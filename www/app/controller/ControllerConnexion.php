<!-- ----- debut ControllerConnexion -->
<?php

class ControllerConnexion
{
    public static function connexionFormulaire(){
        $titre = "Formulaire de connexion";
        $vue = 'viewForm';
        require 'config.php';
        require ($root . '/app/view/connexion/viewForm.php');
    }

    public static function connexion()
    {
        include 'config.php';
        $login = $_GET['login'];
        $password = $_GET['password'];
        $results = ModelPersonne::connexion($login, $password);
        if ($results != -1) {
            $titre = "Connexion réussie";
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $results;
            $vue = $root . '/app/view/connexion/viewConnexionReussie.php';
            require ($vue);

        } else {
            $titre = "Connexion échouée";
            $vue = $root . '/app/view/connexion/viewConnexionEchouee.php';
            require ($vue);
        }
    }

    public static function inscription()
    {
        include 'config.php';
        $titre = "Formulaire d'inscription d'un nouveau client";
        $vue = $root . '/app/view/connexion/viewInscription.php';
        require ($vue);
    }

    public static function insertionInscription()
    {
        include 'config.php';
        $name = $_GET['name'];
        $firstname = $_GET['firstname'];
        $login = $_GET['login'];
        $password = $_GET['password'];
        $results = ModelPersonne::insert($name, $firstname, $login, $password);
        $titre = "Inscription validée";
        $vue = $root . '/app/view/connexion/viewInscriptionValidation.php';
        require ($vue);
    }

    public static function deconnexion()
    {
        include 'config.php';
        $_SESSION["login"] = "vide";
        $_SESSION["role"] = -1;
        $titre = "Deconnexion";
        $vue = $root . '/app/view/connexion/viewDeconnexion.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerConnexion -->