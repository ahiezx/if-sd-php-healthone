<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

// getCategories

// $categories = getCategories();

// die(var_dump(getProducts()));

$products = getProducts();

?>

<body>
    <div class="container">
        <?php
        include_once('../Templates/defaults/header.php');
        include_once('../Templates/defaults/menu.php');
        include_once('../Templates/defaults/pictures.php');
        ?>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <h4>Beheer supportapparaten</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">nr</th>
                    <th scope="col" class="col-5">Naam</th>
                    <th scope="col">Category</th>
                    <th scope="col">Aanpassen</th>
                    <th scope="col">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <th scope="row"><?= $product->id ?></th>
                        <td><?= $product->name ?></td>
                        <td><?= getCategoryName($product->category_id) ?></td>
                        <td><a href="/admin/products/edit/<?= $product->id ?>" class="btn btn-primary">Aanpassen</a></td>
                        <td><a href="/admin/products/delete/<?= $product->id ?>" class="btn btn-danger">Verwijderen</a></td>
                    </tr>
                <?php endforeach; ?>
        </table>
            <hr>
            <?php
            include_once('../Templates/defaults/footer.php');
            ?>
    </div>
</body>

</html>