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
        <h4>Profile</h4>

        <div class="row">
            <div class="col-md-6">
                <h6><?= $user->getFullName() ?></h6>
                <p><?= $user->email ?></p>
            </div>
            <div class="col-md-6">
                <a href="/member/editprofile" class="btn btn-primary">Edit profile</a>
                <a href="/member/changepassword" class="btn btn-primary">Edit password</a>
            </div>
        </div>
            <hr>
            <?php
            include_once('../Templates/defaults/footer.php');
            ?>
    </div>
</body>

</html>