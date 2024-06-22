<!-- ----- debut de la page patrimoine_accueil -->
<?php include 'fragment/fragmentPatrimoineHeader.html'; ?>

<body>
  <div class="container">
    <?php
    include 'fragment/fragmentMenu.php';
    include 'fragment/fragmentPatrimoineJumbotron.html';
    ?>
    <?php
    if (isset($titre)) {
      echo "<h2>$titre</h2>";
    }
    if (isset($messages)) {
      foreach ($messages as $message) {
        echo "<p>$message</p>";
      }
    }
    ?>
  </div>



  <?php
  include 'fragment/fragmentPatrimoineFooter.html';
  ?>

  <!-- ----- fin de la page patrimoine_accueil -->

</body>

</html>