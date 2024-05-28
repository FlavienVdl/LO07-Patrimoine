<!-- ----- debut ControllerResidence -->
<?php
require ('../model/ModelResidence.php');

class ControllerResidence
{
    // --- page d'accueil
    public static function residenceReadAll()
    {
        $titre = "Liste des residences";
        $results = ModelResidence::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/residence/viewAll.php';
        if (DEBUG)
            echo ("ControllerResidence: residenceReadAll : vue = $vue");
        require ($vue);
    }


}
?>
<!-- ----- fin ControllerResidence -->