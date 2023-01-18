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

        if ($product->id == null) {
            header('Location: /home');
        }

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
            $reviewed = true;
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
            <?php if (!(isset($params[3]))) { ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="/img/<?= htmlspecialchars($product->picture) ?>" alt="product picture"
                                        class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h3>
                                        <?= htmlspecialchars($product->name) ?>
                                    </h3>
                                    <p><?= htmlspecialchars($product->description) ?></p>
                                    <p>Category: <a href="/category/<?= htmlspecialchars($category->id) ?>">
                                            <?= htmlspecialchars($category->name) ?>
                                        </a></p>
                                    <!-- input of 5 stars -->
                                    <?php
                                    if (isLogged()) {
                                        ?>
                                        <form action="#" method="post">
                                            <div class="form-group
                                            <?php if (isset($errors['rating'])) {
                                                echo 'has-error';
                                            } ?>">
                                                <!-- description field -->
                                                <label for="description">Review Details</label>
                                                <textarea name="description" id="description" class="form-control mt-2" rows="3"
                                                    placeholder="Description"></textarea>
                                                <label for="rating">Rating</label>
                                                <select name="stars" id="stars" class="form-control mt-2" required>
                                                    <option value="1" <?php if (isset($rating) && $rating == 1) {
                                                        echo 'selected';
                                                    } ?>>1
                                                    </option>
                                                    <option value="2" <?php if (isset($rating) && $rating == 2) {
                                                        echo 'selected';
                                                    } ?>>2
                                                    </option>
                                                    <option value="3" <?php if (isset($rating) && $rating == 3) {
                                                        echo 'selected';
                                                    } ?>>3
                                                    </option>
                                                    <option value="4" <?php if (isset($rating) && $rating == 4) {
                                                        echo 'selected';
                                                    } ?>>4
                                                    </option>
                                                    <option value="5" <?php if (isset($rating) && $rating == 5) {
                                                        echo 'selected';
                                                    } ?>>5
                                                    </option>
                                                </select>
                                                <?php if (isset($errors['rating'])) { ?>
                                                    <span class="help-block"><?= $errors['rating'] ?></span>
                                                <?php } ?>
                                                <!-- display error message if not fields are filled -->
                                                <?php if (isset($errors['description']) || isset($errors['rating'])) { ?>
                                                    <div class="alert alert-danger mt-3" role="alert">
                                                        Please fill in all fields
                                                    </div>
                                                <?php } ?>
                                                <!-- display success message if review is posted -->
                                                <?php if (isset($reviewed)) { ?>
                                                    <div class="alert alert-success mt-3" role="alert">
                                                        Review posted
                                                    </div>
                                                <?php } ?>
                                                <input type="submit" class="btn btn-primary mt-3" value="Send Review">
                                                <?php
                                    } else {
                                        ?>
                                                <div class="alert alert-danger mt-3" role="alert">
                                                    You need to be logged in to post a review
                                                </div>

                                            </div>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Reviews -->
                <div class="col-md-12 reviews">
                    <h3>Reviews</h3>
                    <?php
                    $reviews = new Review();
                    $reviews->getReviewsByProductId($product->id);
                    foreach ($reviews->reviews as $review) {
                        $user = new User();
                        $user = $user->getUserById($review->user_id);
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-md-2">
                                                <img src="/img/<?= htmlspecialchars($user->picture) ?>" alt="user picture"
                                                    class="img-fluid">
                                            </div> -->
                                    <div class="col-md-10">
                                        <h5>Name: <?= htmlspecialchars($user->first_name) ?></h5>
                                        <?php if (isset($review->description) && $review->description != '') { ?>
                                            <p>Review Detials: <?= htmlspecialchars($review->description) ?></p>
                                        <?php } ?>
                                        <p>Posted: <?= htmlspecialchars($review->date) ?></p>
                                        <p>
                                            <?php
                                            for ($i = 0; $i < $review->stars; $i++) {
                                                echo '★';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <hr>
            <?php
            include_once('defaults/footer.php');

            ?>
        </div>
    <script>
        // Get all products
const products = document.querySelectorAll('.card');

// Get the search input
const searchInput = document.querySelector('#product-search');

// Add an event listener to the input
searchInput.addEventListener('input', function() {
  // Get the input value
  const searchValue = this.value.toLowerCase();

  // Loop through all products
  products.forEach(function(product) {
    // Get the product name
    const productName = product.querySelector('.card-title').textContent.toLowerCase();

    // Check if the product name includes the search value
    if (productName.includes(searchValue)) {
      // Show the product
      product.style.display = 'block';
    } else {
      // Hide the product
      product.style.display = 'none';
    }
  });
});
    </script>
</body>

</html>