<!-- ----- début fragmentMenu -->

<nav class="navbar navbar-expand-lg bg-warning fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=caveAccueil">CRANSAC-VIDAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Menu admin -->

        <?php
        include_once $root . '/app/model/ModelPersonne.php';
        if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
          if ($_SESSION['login'] != 'vide' && $_SESSION['role'] != 'vide') {
            if ($_SESSION['role'] == ModelPersonne::ADMINISTRATEUR) {
              include $root . '/app/view/fragment/fragmentNavAdmin.html';
            } else if ($_SESSION['role'] == ModelPersonne::CLIENT) {
              include $root . '/app/view/fragment/fragmentNavClient.html';
            }
          }
        }
        ?>

        <!-- Menu commun -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=formRechercheResidence">Recherche de résidence</a>
            </li>
            <li><a class="dropdown-item" href="router1.php?action=innovationMVC">Proposez une amélioration du code
                MVC</a></li>
          </ul>
        </li>

        <!-- Connexion -->

        <li class="nav-item dropdown">
          <?php
          if (isset($_SESSION['login']) && $_SESSION['login'] != 'vide') {
            echo "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>" . $_SESSION['login'] . "</a>";
            // Afficher le login de la personne connectée;
            echo "<ul class='dropdown-menu'>";
            echo "<li class='nav-item'><a class='nav-link' href='router1.php?action=deconnexion'>Deconnexion</a></li>";
            echo "</ul>";
          } else {
            echo "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Connexion</a>";
            echo "<ul class='dropdown-menu'>";
            echo "<li class='nav-item'><a class='nav-link' href='router1.php?action=connexionFormulaire'>Connexion</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='router1.php?action=inscription'>Inscription</a></li>";
            echo "</ul>";
            ?>
          </li>
          <?php
          } ?>
      </ul>
    </div>
  </div>
</nav>

<!-- ----- fin fragmentMenu -->