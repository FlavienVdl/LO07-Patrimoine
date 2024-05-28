<!-- ----- début viewInscription -->
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
            <input type="hidden" name='action' value='insertionInscription'>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name='name' class="form-control" style="width: 200px">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" name='firstname' class="form-control" style="width: 200px">
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name='login' class="form-control" style="width: 200px">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name='password' class="form-control" style="width: 200px">
            </div>
            <button type="submit" class="btn btn-primary">Go</button>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewInscription -->