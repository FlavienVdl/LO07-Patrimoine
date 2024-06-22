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
            <input type="hidden" name='action' value='residenceBuyValidate'>
            <div class="form-group">
                <label for="compteAcheteur">Sélectionnez un compte de l'acheteur</label>
                <select class="form-control" id='compteAcheteur' name='compteAcheteur' style="width: 200px">
                    <?php
                    foreach ($comptesAcheteur as $element) {
                        printf("<option>%s</option>", $element['label']);
                    }
                    ?>
                </select>
                <label for="compteVendeur">Sélectionnez un compte du vendeur</label>
                <select class="form-control" id='compteVendeur' name='compteVendeur' style="width: 200px">
                    <?php
                    foreach ($comptesVendeur as $comptes) {
                        printf("<option>%s</option>", $comptes['label']);
                    }
                    ?>
                </select>
                <label for="montant">Montant de la transaction</label>
                <input type="text" name='montant' value="<?php echo $prix?>" class="form-control" style="width: 200px" readonly>
                <input type="hidden" name='label' value="<?php echo $_GET["label"] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewForm -->