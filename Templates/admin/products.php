<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

global $params;

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
        <?php if(isset($params[2]) && $params[2] == 'products' && !isset($params[3])) { ?>
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
        <?php } elseif(isset($params[2]) && $params[2] == 'products' && isset($params[3]) && $params[3] == 'edit' && isset($params[4])) { ?>
            <?php 
            // Get product by id using the Product class
            $product = new Product();
            $product = $product->getProductById($params[4]);
            if($product == null) {
                header('Location: /admin/products');
            }
            ?>
            <form action="#" method="post">
                <div class="row">
                    <div class='col-md-6 form-group'>
                        <label for="name">Naam</label>
                        <input type="text" class="form-control" name="name" value="<?= $product->name ?>" required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for="category">Category</label>
                        <select class="form-control" name="category" required>
                            <?php foreach(getCategories() as $category) { ?>
                                <option value="<?= $category->id ?>" <?= $category->id == $product->category_id ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class='col-md-12 form-group mt-2'>
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"><?= $product->description ?></textarea>
                    </div>
                    <!-- image fileupload -->
                    <div class='col-md-12 form-group mt-2'>
                        <label for="image">Afbeelding</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class='col-md-12 form-group mt-2'>
                        <input type="submit" class="btn btn-primary" name="submit" value="Opslaan">
                    </div>
                </div>
            </form>
        <?php } ?>
            <hr>
            <?php
            include_once('../Templates/defaults/footer.php');
            ?>
    </div>
</body>

</html>