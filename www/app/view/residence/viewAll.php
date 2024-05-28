<!-- ----- début viewAll -->
<?php

require($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?>
    <h2><?php echo $titre;?></h2>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">label</th>
            <th scope="col">ville</th>
            <th scope="col">prix</th>
            <th scope="col">propriétaire</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $element) {
            printf(
                "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s %s</td></tr>",
                $element['label'],
                $element['ville'],
                $element['prix'],
                $element['nom'],
                $element['prenom']
            );
        }
        ?>
        </tbody>
    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewAll -->
