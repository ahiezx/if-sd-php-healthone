<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>

<?php

// register user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user = new User();
    $user->email = $email;
    $user->password = $password;
    $user->first_name = $firstname;
    $user->last_name = $lastname;
    $user->role = 'user';
    if ($user->register()) {
        header('Location: /login');
        exit;
    } else {
        $errorMsg = 'Er is iets misgegaan, probeer het opnieuw';
    }
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
                <li class="breadcrumb-item"><a href="/register">Register</a></li>
            </ol>
        </nav>
        <div class="row gy-3 ">
            <?php if (isset($errorMsg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMsg ?>
                </div>
            <?php endif; ?>
            <form action="/register" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <hr>
        <?php
        include_once('defaults/footer.php');
        ?>
    </div>

</body>

</html>