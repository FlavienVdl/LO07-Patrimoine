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
            <input type="hidden" name='action' value='connexionVerif'>
            <div class="form-group">
                <label for="login">Login : </label>
                <input type="text" name='login' class="form-control" style="width: 200px">
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" name='password' class="form-control" style="width: 200px">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewForm -->