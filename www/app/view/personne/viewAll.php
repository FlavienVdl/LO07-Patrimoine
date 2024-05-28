
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
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
            <th scope = "col">nom</th>
            <th scope = "col">prenom</th>
            <th scope = "col">login</th>
            <th scope = "col">password</th>

        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des producteurs est dans une variable $results             
          foreach ($results as $element) {
              printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getNom(), 
                 $element->getPrenom(), $element->getLogin(), $element->getPassword());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  