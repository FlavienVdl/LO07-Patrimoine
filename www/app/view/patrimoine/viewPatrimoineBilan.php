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
        <h2><?php echo $titre ?></h2>
        <table class="table table-striped table-bordered">
            <thead>
                <!-- MEttre le fond des titres en gris -->
                <tr>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Label</th>
                    <th scope="col">Valeur</th>
                    <th scope="col">Capital</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $capital = 0;
                foreach ($comptes as $c) {
                    $capital += $c['montant'];
                    printf(
                        "<tr class='%s'><td>%s</td><td>%s</td><td class='text-end'>%d</td><td class='text-end'>%d</td></tr>",
                        "bg-info",
                        "compte",
                        $c['label'],
                        $c['montant'],
                        $capital
                    );
                }
                foreach ($residences as $r) {
                    $capital += $r['prix'];
                    printf(
                        "<tr class='%s'><td>%s</td><td>%s</td><td class='text-end'>%d</td><td class='text-end'>%d</td></tr>",
                        "bg-success",
                        "résidence",
                        $r["label"],
                        $r["prix"],
                        $capital
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

    <!-- ----- fin viewAll -->