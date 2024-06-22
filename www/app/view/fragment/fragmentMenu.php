<!-- ----- début fragmentMenu -->

<nav class="navbar navbar-expand-lg fixed-top bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=patrimoineAccueil">CRANSAC-VIDAL
      <?php
      if (isset($_SESSION['role']) && $_SESSION['role'] != -1) {
        $_SESSION['role'] == ModelPersonne::ADMINISTRATEUR ? print (" | administrateur") : print (" | client");
      }
      if (isset($_SESSION['login']) && $_SESSION['login'] != 'vide') {
        echo " | " . $_SESSION['login'];
      }
      ?>
    </a>
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
          <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Se
            connecter</a>
          <ul class='dropdown-menu'>
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] != 'vide') { ?>
              <li class='nav-item'><a class='nav-link' href='router1.php?action=deconnexion'>Deconnexion</a></li>
            <?php } else { ?>
              <li class='nav-item'><a class='nav-link' href='router1.php?action=connexionFormulaire'>Connexion</a></li>
              <li class='nav-item'><a class='nav-link' href='router1.php?action=inscription'>Inscription</a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- ----- fin fragmentMenu -->