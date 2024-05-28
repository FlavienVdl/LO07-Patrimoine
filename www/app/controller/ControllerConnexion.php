<!-- ----- debut ControllerConnexion -->
<?php
require_once '../model/ModelPersonne.php';

class ControllerConnexion
{
    public static function connexionFormulaire(){
        $titre = "Formulaire de connexion";
        $vue = 'viewForm';
        require 'config.php';
        require ($root . '/app/view/connexion/viewForm.php');
    }

    public static function inscription()
    {
        include 'config.php';
        $titre = "Formulaire d'inscription d'un nouveau client";
        $vue = $root . '/app/view/connexion/viewInscription.php';
        require ($vue);
    }

}
?>
<!-- ----- fin ControllerConnexion -->