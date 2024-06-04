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
            <input type="hidden" name='action' value='verifTransfertCompte'>
            <div class="form-group">
                <label for="compte1">Compte à débiter : </label>
                <select class="form-control" id='compte1' name='compte1' style="width: 200px">
                    <?php
                    foreach ($results as $compte) {
                        echo ("<option value=" . $compte["id"] . ">" . $compte['label'] . "</option>");
                    }
                    ?>
                </select>
                <label for="compte2">Compte à créditer : </label>
                <select class="form-control" id='compte2' name='compte2' style="width: 200px">
                    <?php
                    for ($i = 0; $i < count($results); $i++) {
                        echo ("<option value=" . $results[$i]["id"] . ">" . $results[$i]['label'] . "</option>");
                    }
                    ?>
                </select>
                <label for="montant">Montant : </label>
                <input type="number" step="any" name='montant' class="form-control" style="width: 200px">
                <input type="submit" value="Go" class="btn btn-primary">
            </div>
        </form>

    </div>
</body>
<?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewForm -->