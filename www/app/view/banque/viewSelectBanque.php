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
        <h2>Liste des banques</h2>
        <form role="form" method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='comptesBanqueSelected'>
                <label for="id">banque : </label> <select class="form-control" id='id' name='banque'
                    style="width: 100px">
                    <?php
                    foreach ($results as $banque) {
                        echo ("<option>$banque</option>");
                    }
                    ?>
                </select>
            </div>
            <p/><br />
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
</body>
<?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewAll -->