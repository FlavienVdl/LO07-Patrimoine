<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerPatrimoine.php');
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');
require_once ('../controller/ControllerConnexion.php');
require ('../controller/ControllerInnovations.php');
session_start();


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// Modification du routeur pour empêcher l'accès à des vues non autorisées

$trouve = false;
if ($_SESSION['role'] == ModelPersonne::CLIENT) {
  switch ($action) {
    case "compteReadAllOfClient":
    case "compteCreate":
    case "ajoutCompte":
    case "compteTransfert":
    case "verifTransfertCompte":
    case "residenceClientReadAll":
    case "residenceSelection":
    case "residenceBuyForm":
    case "residenceBuyValidate":
    case "patrimoineBilan":
      $trouve = true;
      ControllerClient::$action();
      break;
    default:
      break;
  }
} else if ($_SESSION['role'] == ModelPersonne::ADMINISTRATEUR) {
  switch ($action) {
    case "adminReadAll":
    case "clientReadAll":
    case "banqueReadAll":
    case "banqueCreate":
    case "banqueCreated":
    case "banqueSelect":
    case "comptesBanqueSelected":
    case "clientReadComptes":
    case "residenceReadAll":
      $trouve = true;
      ControllerAdministrateur::$action();
      break;
    default:
      break;
  }
}
if (!$trouve) {
  switch ($action) {

    case "connexionFormulaire":
      case "deconnexion":
      case "inscription":
      case "insertionInscription":
      case "connexion":
        ControllerConnexion::$action();
        break;
      case "formRechercheResidence":
      case "rechercheResidence":
      case "innovationMVC":
        ControllerInnovations::$action();
        break;
      default:
        $action = "patrimoineAccueil";
        ControllerPatrimoine::$action();
  }
}


// --- Liste des méthodes autorisées
switch ($action) {
  // Banques
  // Tache par défaut
}


?>
<!-- ----- Fin Router1 -->