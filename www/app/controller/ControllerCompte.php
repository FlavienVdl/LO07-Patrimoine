<!-- ----- debut ControllerCompte -->
<?php
require_once '../model/ModelCompte.php';

class ControllerCompte
{

    // --- Liste des Comptes
    public static function clientReadComptes()
    {
        $results = ModelCompte::getAll();
        $titre = "Liste des comptes";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/compte/viewAll.php';
        if (DEBUG)
            echo ("ControllerCompte: banqueReadAll : vue = $vue");
        require ($vue);
    }

    public static function comptesBanqueSelected()
    {
        $titre = "Liste des comptes de cette banque : " . $_GET['banque'];
        $results = ModelCompte::getComptesByBanque($_GET['banque']);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/compte/viewAll.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerCompte -->