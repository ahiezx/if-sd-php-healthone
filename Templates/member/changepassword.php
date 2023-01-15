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
        <h4>Change Password</h4>
        <form>
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password"
                    placeholder="Enter your current password">
            </div>
            <div class="form-group mt-2">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" placeholder="Enter your new password">
            </div>
            <div class="form-group mt-2">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password"
                    placeholder="Confirm your new password">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Change Password</button>
        </form>
        <hr>
        <?php
        include_once('../Templates/defaults/footer.php');
        ?>
    </div>
</body>

</html>