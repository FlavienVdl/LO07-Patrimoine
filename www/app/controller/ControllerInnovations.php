<?php

Class ControllerInnovations {
    public static function innovationMVC(){
        include 'config.php';
        $titre = "Innovations mvc";
        $vue = $root . '/app/view/innovations/viewMVC.php';
        require ($vue);
    }

    public static function formRechercheResidence(){
        include 'config.php';
        $titre = "Recherche de résidence";
        $vue = $root . '/app/view/innovations/viewFormVide.php';
        require ($vue);
    }

    // effectue la recherche en fonction des paramètres
    public static function rechercheResidence(){
        include 'config.php';
        $titre = "Résultat de la recherche";
        $nom = $_GET['nom'];
        $lieu = $_GET['lieu'];
        $prixMin = $_GET['prix-min'];
        $prixMax = $_GET['prix-max'];
        $results = ModelResidence::getResidence($nom, $lieu, $prixMin, $prixMax);
        $vue = $root . '/app/view/innovations/viewResults.php';
        require ($vue);
    }
}