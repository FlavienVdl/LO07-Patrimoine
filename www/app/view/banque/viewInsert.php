<!-- ----- début viewInsert -->
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
        <form role="form" action="router1.php" method="get">
            <input type="hidden" name='action' value='banqueCreated'>
            <div class="form-group">
                <label for="label">label</label><input type="text" name='label' class="form-control">
            </div>
            <div class="form-group">
                <label for="pays">pays</label><input type="text" name='pays' class="form-control">
            </div>

            <button class="btn btn-primary" type="submit">GO</button>
        </form>
    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewInsert -->