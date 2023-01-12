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

    <?php

    $product = new Product();
    $category = new Category();
    
    $product->getProductById($params[2]);
    
    $category->getCategoryById($product->category_id);

    ?>

    <?php
    
    // check for post request of review

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate
        $review = new Review();
        $review->name = $product->name;
        $review->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $review->stars = filter_var($_POST['stars'], FILTER_SANITIZE_NUMBER_INT);
        $review->user_id = $_SESSION['user']->id;
        $review->product_id = $product->id;
        $review->date = date("Y-m-d H:i:s");
        $review->save();
        die('review sent');
    }

    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
            <li class="breadcrumb-item"><a href='/category/<?= htmlspecialchars($category->id) ?>'>
                    <?= htmlspecialchars($category->name) ?>
            </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= htmlspecialchars($product->name) ?>
            </li>
        </ol>
    </nav>
    <div class="row gy-3 ">
        <!-- Review -->
        <?php if(!(isset($params[3]) && ($params[3] == "review"))) { ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/img/<?= htmlspecialchars($product->picture) ?>" alt="product picture"
                                class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h3><?= htmlspecialchars($product->name) ?></h3>
                            <p><?= htmlspecialchars($product->description) ?></p>
                            <p>Category: <a href="/category/<?= htmlspecialchars($category->id) ?>">
                                    <?= htmlspecialchars($category->name) ?>
                                </a></p>
                            <a href="/product/<?= htmlspecialchars($product->id) ?>/review" class="btn btn-warning">Review</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if(isset($params[3]) && ($params[3] == "review")) { ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/img/<?= htmlspecialchars($product->picture) ?>" alt="product picture"
                                class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h3><?= htmlspecialchars($product->name) ?></h3>
                            <p><?= htmlspecialchars($product->description) ?></p>
                            <p>Category: <a href="/category/<?= htmlspecialchars($category->id) ?>">
                                    <?= htmlspecialchars($category->name) ?>
                                </a></p>
                            <!-- input of 5 stars -->
                            <form action="#" method="post">
                            <div class="form-group
                            <?php if(isset($errors['rating'])) { echo 'has-error'; } ?>">
                                <!-- description field -->
                                <label for="description">Review Details</label>
                                <textarea name="description" id="description" class="form-control mt-2" rows="3"
                                    placeholder="Description"></textarea>
                                <label for="rating">Rating</label>
                                <select name="stars" id="stars" class="form-control mt-2">
                                    <option value="1" <?php if(isset($rating) && $rating == 1) { echo 'selected'; } ?>>1
                                    </option>
                                    <option value="2" <?php if(isset($rating) && $rating == 2) { echo 'selected'; } ?>>2
                                    </option>
                                    <option value="3" <?php if(isset($rating) && $rating == 3) { echo 'selected'; } ?>>3
                                    </option>
                                    <option value="4" <?php if(isset($rating) && $rating == 4) { echo 'selected'; } ?>>4
                                    </option>
                                    <option value="5" <?php if(isset($rating) && $rating == 5) { echo 'selected'; } ?>>5
                                    </option>
                                </select>
                                <?php if(isset($errors['rating'])) { ?>
                                <span class="help-block"><?= $errors['rating'] ?></span>
                            <?php } ?>
                                    <input type="submit" class="btn btn-primary mt-3" value="Send Review">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <hr>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

