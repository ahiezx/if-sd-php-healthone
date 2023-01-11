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

switch ($params[1]) {

    case $params[1]:
        $category = $category->getCategoryById($params[2]);
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
                    <div class="col-sm-4">
                        <img class="product-img img-responsive center-block"
                            src='/img/<?= htmlspecialchars($category->picture) ?>' />
                    </div>
                    <div class="col-sm-8">
                        <p class="lead">
                            <?= htmlspecialchars($category->description) ?>
                        </p>
                        <a href="#" class="btn btn-warning text-light">
                            Add Review
                        </a>
                    </div>
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