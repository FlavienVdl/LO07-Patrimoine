<!-- ----- début viewAll -->
<?php
require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?>
    <h2><?php echo $titre ?></h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Prénom</th>
          <th scope="col">Nom</th>
          <th scope="col">Banque</th>
          <th scope="col">Compte</th>
          <th scope="col">Montant</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results as $element) {
          printf(
            "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
            $element['prenom'],
            $element['nom'],
            $element['banque_label'],
            $element['label'],
            $element['montant'],
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->