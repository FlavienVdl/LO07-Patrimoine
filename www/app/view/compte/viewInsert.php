<!-- ----- début viewForm -->
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
        <form action="">
            <input type="hidden" name='action' value='ajoutCompte'>
            <div class="form-group">
                <label for="label">Label : </label>
                <input type="text" name='label' class="form-control" style="width: 200px">
                <label for="montant">Montant : </label>
                <input type="number" step="any" name='montant' class="form-control" style="width: 200px">
                <label for="banque">Banque : </label>
                <select class="form-control" id='banque' name='banque' style="width: 200px">
                    <?php
                    foreach ($results as $banque) {
                        echo ("<option value=" . $banque->getId() . ">" . $banque->getLabel() . "</option>");
                    }
                    ?>
                </select>
                <input type="submit" value="Go" class="btn btn-primary">
            </div>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewForm -->