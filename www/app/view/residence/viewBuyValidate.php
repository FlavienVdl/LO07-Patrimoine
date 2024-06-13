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
        <?php if (isset($message)) {
            echo "<p>$message</p>";
        }
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewInscriptionValidation -->