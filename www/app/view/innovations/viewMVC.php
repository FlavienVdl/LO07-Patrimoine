<!-- ----- début viewMVC -->
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
        <?php if (isset($messages)) {
            foreach ($messages as $message) {
                echo "<p>$message</p>";
            }
        } ?>

        <ul>
            <li>Ajout de variable de contenu dans les pages ($titre, $message) pour réutiliser les vues en changeant facilement de titre et ajouter des messages d'erreur</li>
            <li>Conditions dans le routeur pour empêcher complétement les fonctionnalités administrateures aux clients et inversement</li>
        </ul>
    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewInscription -->