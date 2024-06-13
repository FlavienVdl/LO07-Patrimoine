
<!-- ----- debut ControllerPatrimoine -->
<?php

class ControllerPatrimoine {
    // --- page d'accueil
 public static function patrimoineAccueil() {
    include 'config.php';
    $vue = $root . '/app/view/viewPatrimoineAccueil.php';
    if (DEBUG)
     echo ("ControllerPatrimoine : patrimoineAccueil : vue = $vue");
    require ($vue);
   }

}
?>
<!-- ----- fin ControllerPatrimoine -->


