<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerBanque.php');
require ('../controller/ControllerPatrimoine.php');
require ('../controller/ControllerCompte.php');
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');
require ('../controller/ControllerResidence.php');
require ('../controller/ControllerConnexion.php');
session_start();


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// Modification du routeur pour empêcher l'accès à des vues non autorisées
if ($_SESSION['role'] == ModelPersonne::CLIENT) {
  switch ($action) {
    case "compteReadAllOfClient":
      ControllerCompte::$action();
      break;
    case "compteCreate":
      ControllerCompte::$action();
      break;
    case "ajoutCompte":
      ControllerCompte::$action();
      break;
    case "compteTransfert":
      ControllerCompte::$action();
      break;
    case "verifTransfertCompte":
      ControllerCompte::$action();
      break;
    default:
      $action = "patrimoineAccueil";
      ControllerPatrimoine::$action();
  }
} else if ($_SESSION['role'] == ModelPersonne::ADMINISTRATEUR) {
  switch ($action) {
    case "adminReadAll":
      ControllerAdministrateur::$action();
      break;

    case "clientReadAll":
      ControllerClient::$action();
      break;
    case "banqueReadAll":
      ControllerBanque::$action();
      break;
    case "banqueCreate":
      ControllerBanque::$action();
      break;
    case "banqueCreated":
      ControllerBanque::$action();
      break;
    case "banqueSelect":
      ControllerBanque::$action();
      break;
    case "comptesBanqueSelected":
      ControllerCompte::$action();
      break;
    case "clientReadComptes":
      ControllerCompte::$action();
      break;
    case "clientReadAll":
      ControllerAdministrateur::$action();
      break;
    case "adminReadAll":
      ControllerAdministrateur::$action();
      break;
    case "residenceReadAll":
      ControllerResidence::$action();
      break;
    default:
      $action = "patrimoineAccueil";
      ControllerPatrimoine::$action();
  }
} else {
  switch ($action) {
    case "connexionFormulaire":
      ControllerConnexion::$action();
      break;
    case "deconnexion":
      ControllerConnexion::$action();
      break;
    case "inscription":
      ControllerConnexion::$action();
      break;
    case "insertionInscription":
      ControllerConnexion::$action();
      break;
    case "connexion":
      ControllerConnexion::$action();
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