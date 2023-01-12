<?php
//var_dump($_SESSION);
//var_dump($_POST);
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
        if($category->id == null) {header("Location: /home");}
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
                    <?= htmlspecialchars($category->name) ?>
                </h1>
                <div class="d-flex">
                    <!-- get products by category id -->
                    <?php
                        $products = $product->getProductsByCategoryId($category->id);
                        foreach ($products as $product) {
                            echo "<div class='col-md-4'>";
                            echo "<div class='card'>";
                            echo "<img src='/img/" . htmlspecialchars($product->picture) . "' class='card-img-top w-50' alt='...'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($product->name) . "</h5>";
                            echo "<p class='card-text'>" . htmlspecialchars($product->description) . "</p>";
                            echo "<a href='/product/" . htmlspecialchars($product->id) . "' class='btn btn-primary'>Review</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
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

</body>

</html>