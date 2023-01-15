<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

global $params;

$user = $_SESSION['user'];

?>

<body>
    <div class="container">
        <?php
        include_once('../Templates/defaults/header.php');
        include_once('../Templates/defaults/menu.php');
        include_once('../Templates/defaults/pictures.php');
        ?>
        <h4>Edit Profile</h4>

        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group mt-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <div class="form-group mt-2">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation"
                    placeholder="Confirm your password">
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