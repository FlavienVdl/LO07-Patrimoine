<!-- ----- debut ControllerAdministrateur -->
<?php
require ('../model/ModelPersonne.php');

class ControllerAdministrateur
{
    public static function clientReadAll()
    {
        $titre = "Liste des clients";
        $results = ModelPersonne::getAllClient();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewAll.php';
        if (DEBUG)
            echo ("ControllerAdministrateur: banqueReadAll : vue = $vue");
        require ($vue);
    }

    public static function adminReadAll()
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
<!-- ----- fin ControllerAdministrateur -->