<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>

<?php

// logout user
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_destroy();
    header('Location: /home');
    exit;
}

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
            <li class="breadcrumb-item"><a href="/logout">Logout</a></li>
        </ol>
    </nav>
    <div class="row gy-3 ">
        <p>You have successfully logged out!</p>
    </div>

    <hr>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>

</body>
</html>

