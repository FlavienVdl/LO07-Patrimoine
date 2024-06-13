<!-- ----- debut ControllerAdministrateur -->
<?php
require ('../model/ModelPersonne.php');
require_once '../model/ModelBanque.php';
require_once '../model/ModelResidence.php';
require_once '../model/ModelCompte.php';

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


    // Toutes les résidences
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

    // --- Liste des Banques
    public static function banqueReadAll()
    {
        $titre = "Liste des banques";
        $results = ModelBanque::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewAll.php';
        if (DEBUG)
            echo ("ControllerBanque: banqueReadAll : vue = $vue");
        require ($vue);
    }

    // Affiche le formulaire de creation d'un banque
    public static function banqueCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewInsert.php';
        $titre = "Ajout d'une nouvelle banque";
        require ($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau banque.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function banqueCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelBanque::insert(
            htmlspecialchars($_GET['label']),
            htmlspecialchars($_GET['pays'])
        );
        $titre = "Confirmation d'ajout d'une nouvelle banque";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewInserted.php';
        require ($vue);
    }

    
    public static function banqueSelect()
    {
        $results = ModelBanque::getAllBanque();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewSelectBanque.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerAdministrateur -->