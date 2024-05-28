<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerBanque.php');
require ('../controller/ControllerPatrimoine.php');
require ('../controller/ControllerCompte.php');
require ('../controller/ControllerPersonne.php');
require ('../controller/ControllerResidence.php');
require ('../controller/ControllerConnexion.php');


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- Liste des méthodes autorisées
switch ($action) {
  // Banques
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
    ControllerPersonne::$action();
    break;
  case "clientFilterAdmin":
    ControllerPersonne::$action();
    break;
  case "residenceReadAll":
    ControllerResidence::$action();
    break;
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
  case "connexionVerif":
    ControllerConnexion::$action();
    break;
  // Tache par défaut
  default:
    $action = "patrimoineAccueil";
    ControllerPatrimoine::$action();
}
?>
<!-- ----- Fin Router1 -->