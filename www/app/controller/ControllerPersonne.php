<!-- ----- debut ControllerPersonne -->
<?php
require ('../model/ModelPersonne.php');

class ControllerPersonne
{
    // --- page d'accueil
    public static function clientReadAll()
    {
        $titre = "Liste des clients";
        $results = ModelPersonne::getAllClient();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewAll.php';
        if (DEBUG)
            echo ("ControllerPersonne: banqueReadAll : vue = $vue");
        require ($vue);
    }

    public static function clientFilterAdmin()
    {
        $titre = "Liste des admins";
        $results = ModelPersonne::getAllAdmin();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewAll.php';
        if (DEBUG)
            echo ("ControllerPersonne: banqueReadAll : vue = $vue");
        require ($vue);
    }

}
?>
<!-- ----- fin ControllerPersonne -->