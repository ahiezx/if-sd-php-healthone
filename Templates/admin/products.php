<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

global $params;

$products = getProducts();

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'update') {
    
    // Update product using object
    $product = new Product();
    $product->id = $params[4];
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
    var_dump($product->update());

    // die(var_dump($product));
} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'create') {
    // Create product using object
    $product = new Product();
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
    $product->create();
}

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
        <div class='row'>
            <div class='col-md-10'>
                <h4>Beheer supportapparaten</h4>
            </div>
            <div class='col-md-2'>
                <a href="/admin/products/create" class="btn btn-primary">Toevoegen</a>
            </div>
        </div>
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
                        <select class="form-control" name="category_id" required>
                            <?php foreach(getCategories() as $category) { ?>
                                <!-- echo $category->id; -->
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
                        <input type="hidden" name="action" value="update">
                        <input type="submit" class="btn btn-primary" name="submit" value="Opslaan">
                    </div>
                </div>
            </form>
        <?php } ?>
        <?php if(isset($params[2]) && $params[2] == 'products' && isset($params[3]) && $params[3] == 'delete' && isset($params[4])) { ?>
            <?php
            // Delete product using object
            $product = new Product();
            $product->id = $params[4];
            $product->delete();
            header('Location: /admin/products');
            ?>
        <?php } ?>

        <?php if(isset($params[2]) && $params[2] == 'products' && isset($params[3]) && $params[3] == 'create') { ?>
            <form action="#" method="post">
                <div class="row">
                    <div class='col-md-6 form-group'>
                        <label for="name">Naam</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for="category">Category</label>
                        <select class="form-control" name="category_id" required>
                            <?php foreach(getCategories() as $category) { ?>
                                <!-- echo $category->id; -->
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class='col-md-12 form-group mt-2'>
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <!-- image fileupload -->
                    <div class='col-md-12 form-group mt-2'>
                        <label for="image">Afbeelding</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class='col-md-12 form-group mt-2'>
                        <input type="hidden" name="action" value="create">
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