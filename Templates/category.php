<?php

$message = "";

$request = $_SERVER['REQUEST_URI'];

$params = explode("/", $request);
// print_r($request);
$title = "HealthOne";
$titleSuffix = "";

$currentCategory = "";

$category = new Category();

$product = new Product();

switch ($params[1]) {

    case $params[1]:
        $category = $category->getCategoryById($params[2]);
        if ($category->id == null) {
            header("Location: /home");
        }
        $titleSuffix = " | " . $category->name;
        break;
}

?>

<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>

<body>

    <div class="container">
        <?php
        include_once('defaults/header.php');
        include_once('defaults/menu.php');
        include_once('defaults/pictures.php');
        ?>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                <li class="breadcrumb-item"><a href='<?= htmlspecialchars($category->id) ?>'>
                        <?= htmlspecialchars($category->name) ?>
                    </a></li>
            </ol>
        </nav>
        <div class="row gy-3 ">

            <div class="category-info">
                <h1>
                    <?= $category->name ?>
                </h1>
                <label for="product-search">Search for a product:</label>
                <input type="search" id="product-search" name="product-search">
                <input type="submit" value="Search">
                <div class="d-flex flex-wrap">
                    <!-- get products by category id -->
                    <?php
                    $products = $product->getProductsByCategoryId($category->id);
                    foreach ($products as $product) {
                        echo '<div class="col-md-2 m-2 mx-auto">';
                        echo '<a href="/product/' . $product->id . '" class="text-decoration-none text-body">';
                        echo '<div class="card text-center">';
                        echo '<img src="/' . $product->picture . '" class="card-img-top w-100 mx-auto" alt="' . $product->name . '">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $product->name . '</h5>';
                        echo '<p class="card-text" style="font-size:14px;">' . $product->description . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        </div>

        <hr>
        <?php
        include_once('defaults/footer.php');

        ?>
    </div>

    <script>
        const products = document.querySelectorAll('.card');

        const searchInput = document.querySelector('#product-search');

        searchInput.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();

            products.forEach(function (product) {
                const productName = product.querySelector('.card-title').textContent.toLowerCase();

                if (productName.includes(searchValue)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>