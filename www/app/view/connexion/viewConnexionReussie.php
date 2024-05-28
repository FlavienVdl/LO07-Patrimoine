<!-- ----- début viewInscriptionValidation -->
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
        }
        ?>
        <div class="panel panel-success">
            <div class="panel-body">Bienvenue <?php echo $_SESSION["login"] ?></div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewInscriptionValidation -->