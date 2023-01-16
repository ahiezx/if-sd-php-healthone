<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');

global $params;

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (password_verify($_POST['current_passwd'], $user->password)) {
        $user->password = $_POST['new_passwd'];
        if ($user->update()) {
            $_SESSION['user'] = $user;
            $success = 'Password updated successfully';
        } else {
            $error = 'Something went wrong';
        }
    } else {
        $error = 'Current password is incorrect';
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
        <h4>Change Password</h4>

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
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" name="current_passwd" id="current_password"
                    placeholder="Enter your current password">
            </div>
            <div class="form-group mt-2">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" name="new_passwd" id="new_password" placeholder="Enter your new password">
            </div>
            <div class="form-group mt-2">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_passwd" id="confirm_password"
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