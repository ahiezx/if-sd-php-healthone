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
        <h4>Beheer</h4>
        <div class="container mx-auto">
            <div class="row text-center mt-2">
                <div class="col-4">
                    <a href="/admin/products" class="btn btn-primary">Supportapparaten</a>
                </div>
                <div class="col-4">
                    <a href="/admin/categories" class="btn btn-primary">Categorieën</a>
                </div>
                <div class="col-4">
                    <a href="/admin/users" class="btn btn-primary">Gebruikers</a>
                </div>
            </div>
        </div>
        <hr>
        <?php
        include_once('../Templates/defaults/footer.php');
        ?>
    </div>
</body>

</html>