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
            <input type="hidden" name='action' value='residenceBuyForm'>
            <div class="form-group">
                <label for="label">Residence : </label>
                <select class="form-control" id='label' name='label' style="width: 200px">
                    <?php
                    foreach ($results as $element) {
                        printf("<option>%s</option>", $element['label']);
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewForm -->