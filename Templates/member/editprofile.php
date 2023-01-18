<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

global $params;

$user = $_SESSION['user'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];

    if($user->update()) {
        $_SESSION['user'] = $user;
        $success = 'Profile updated successfully';
    } else {
        $error = 'Something went wrong';
    }

}

?>

<body>
    <div class="container">
        <?php
        include_once('../Templates/defaults/header.php');
        include_once('../Templates/defaults/menu.php');
        include_once('../Templates/defaults/pictures.php');
        ?>
        <h4>Edit Profile</h4>

        <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <?php if (isset($success)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
        <?php endif; ?>

        <form action="#" method="post">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name='first_name' id="name" placeholder="Enter your name" value='<?= $user->first_name ?>'>
            </div>
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" class="form-control" name='last_name' id="name" placeholder="Enter your name" value='<?= $user->last_name ?>'>
            </div>            
            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" name='email' id="email" placeholder="Enter your email" value='<?= $user->email ?>'>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
        </form>

        <hr>
        <?php
        include_once('../Templates/defaults/footer.php');
        ?>
    </div>
</body>

</html>