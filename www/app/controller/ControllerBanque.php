<!-- ----- debut ControllerBanque -->
<?php
require_once '../model/ModelBanque.php';

class ControllerBanque
{

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

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function banqueReadId()
    {
        $results = ModelBanque::getAllId();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewId.php';
        require ($vue);
    }

    // Affiche un banque particulier (id)
    public static function banqueReadOne()
    {
        $banque_id = $_GET['id'];
        $results = ModelBanque::getOne($banque_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewAll.php';
        require ($vue);
    }

    // Affiche le formulaire de creation d'un banque
    public static function banqueCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/banque/viewInsert.php';
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
<!-- ----- fin ControllerBanque -->