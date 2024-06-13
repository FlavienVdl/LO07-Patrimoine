<!-- ----- debut ControllerClient -->
<?php

require_once '../model/ModelPersonne.php';
require_once '../model/ModelBanque.php';
require_once '../model/ModelResidence.php';
require_once '../model/ModelCompte.php';

class ControllerClient
{
    public static function compteReadAllOfClient()
    {
        $results = ModelCompte::getAllOfClient($_SESSION['login']);
        $titre = "Liste des comptes";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/compte/viewAll.php';
        if (DEBUG)
            echo ("ControllerCompte: compteReadAllOfClient : vue = $vue");
        require ($vue);
    }

    // Affiche le formulaire de création d'un compte
    public static function compteCreate()
    {
        $results = ModelBanque::getAll();
        $titre = "Création d'un compte";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/compte/viewInsert.php';
        require ($vue);
    }

    // Ajoute le compte dans la base
    public static function ajoutCompte()
    {
        $titre = "Ajout d'un compte";
        $label = $_GET['label'];
        $montant = $_GET['montant'];
        $banque = $_GET['banque'];
        $personne = ModelPersonne::getPersonneByLogin($_SESSION['login']);
        $messages = ModelCompte::insert($label, $montant, $banque, $personne->getId());
        include 'config.php';
        $vue = $root . '/app/view/compte/viewInserted.php';
        require ($vue);
    }

    //affiche le formulaire de transfert de compte 
    public static function compteTransfert()
    {
        $results = ModelCompte::getAllOfClient($_SESSION['login']);
        if (count($results) < 2) {
            $messages = array();
            $messages[] = "Vous n'avez pas assez de comptes pour effectuer un transfert";
            $titre = "Transfert d'un compte impossible";
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/compte/viewAll.php';
            require ($vue);
        } else {
            $titre = "Transfert d'un compte";
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/compte/viewTransfert.php';
            require ($vue);
        }
    }

    // vérifie les informations du transfert et les transfert
    public static function verifTransfertCompte()
    {
        $titre = "Transfert d'un compte";
        $montant = $_GET['montant'];
        $id_compte = $_GET['compte1'];
        $id_compte2 = $_GET['compte2'];
        $messages = array();
        if ($id_compte == $id_compte2) {
            $messages[] = "Les comptes sont les mêmes";
        } else {
            $compte1 = ModelCompte::getCompteById($_GET['compte1']);
            $compte2 = ModelCompte::getCompteById($_GET['compte2']);
            if ($compte1["montant"] < $montant) {
                $messages = array();
                $messages[] = "Le compte à débiter n'a pas assez d'argent";
            } else {
                $messages = ModelCompte::transfert($compte1, $compte2, $montant);
            }
        }
        include 'config.php';
        $vue = $root . '/app/view/compte/viewTransfertValidation.php';
        require ($vue);
    }


    public static function residenceSelection()
    {
        $titre = "Selection d'une residence";
        $results = ModelResidence::getAllWithoutAcheteur();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/residence/viewSelect.php';
        if (DEBUG)
            echo ("ControllerResidence: residenceSelection : vue = $vue");
        require ($vue);
    }

    public static function residenceBuyForm()
    {
        $label = $_GET['label'];
        $titre = "Achat de la résidence : " . $_GET['label'];
        $residence_id = ModelResidence::getResidencePersonneIdByLabel($label);
        $comptesAcheteur = ModelCompte::getAllOfClient($_SESSION['login']);
        $comptesVendeur = ModelCompte::getAllOfClientById($residence_id);
        $prix = ModelResidence::getResidenceByLabel($label)['prix'];
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/residence/viewBuyForm.php';
        if (DEBUG)
            echo ("ControllerResidence: residenceBuyForm : vue = $vue");
        require ($vue);
    }

    public static function residenceBuyValidate()
    {
        $compteAcheteur = $_GET['compteAcheteur'];
        $compteVendeur = $_GET['compteVendeur'];
        $montant = $_GET['montant'];
        $label = $_GET['label'];
        $residence = ModelResidence::getResidenceByLabel($label);
        $compteAcheteur = ModelCompte::getCompteByLabel($compteAcheteur);
        $compteVendeur = ModelCompte::getCompteByLabel($compteVendeur);
        $compteAcheteur_montant = $compteAcheteur['montant'];
        $compteVendeur_montant = $compteVendeur['montant'];
        if ($compteAcheteur_montant >= $montant) {
            $compteAcheteur_montant -= $montant;
            $compteVendeur_montant += $montant;
            ModelCompte::update($compteAcheteur['id'], $compteAcheteur_montant);
            ModelCompte::update($compteVendeur['id'], $compteVendeur_montant);
            ModelResidence::updatePersonneId($compteAcheteur["personne_id"], $residence["id"]);
            $titre = "Transaction réussie";
            $message = "La transaction a été effectuée avec succès";
        } else {
            $titre = "Transaction échouée";
            $message = "Le compte acheteur n'a pas assez d'argent pour effectuer la transaction";
        }
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/residence/viewBuyValidate.php';
        if (DEBUG)
            echo ("ControllerResidence: residenceBuyValidate : vue = $vue");
        require ($vue);
    }


    public static function residenceClientReadAll()
    {
        $titre = "Liste des residences";
        $results = ModelResidence::getAllOfClient($_SESSION['login']);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/residence/viewAll.php';
        if (DEBUG)
            echo ("ControllerResidence: residenceClientReadAll : vue = $vue");
        require ($vue);
    }


    public static function patrimoineBilan()
    {
        $personne = ModelPersonne::getPersonneByLogin($_SESSION['login']);
        $titre = "Patrimoine de " . $personne->getPrenom() . " " . $personne->getNom();
        $comptes = ModelCompte::getAllOfClient($_SESSION['login']);
        $residences = ModelResidence::getAllOfClient($_SESSION['login']);
        include 'config.php';
        $vue = $root . '/app/view/patrimoine/viewPatrimoineBilan.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerPatrimoine -->