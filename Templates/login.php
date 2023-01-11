<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>

<?php

// die if user is logged in

if (isset($_SESSION['user'])) {
    die('You are already logged in');
}

// login user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = new User();
    $user->email = $email;
    $user->password = $password;
    if($user->login()) {
        header('Location: /home');
        exit;
    } else {
        $errorMsg = 'Onjuist e-mailadres of wachtwoord, probeer het opnieuw';
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
            <li class="breadcrumb-item"><a href="/login">Login</a></li>
        </ol>
    </nav>
    <div class="row gy-3 ">
        <!-- error paragraph -->
        <?php if (isset($errorMsg)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMsg ?>
            </div>
        <?php endif; ?>
        <form action="/login" method="post">

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <hr>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>

</body>
</html>

