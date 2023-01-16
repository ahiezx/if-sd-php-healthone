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
            <div class="col-md-12">
                <div class='row'>
                <div class='col-md-6'>
                    <p>
                        email
                    </p>
                    <hr>
                    <p>
                        firstname
                    </p>
                    <hr>
                    <p>
                        lastname
                    </p>
                    <hr>
                </div>
                <div class='col-md-6'>
                    <p>
                        <?= $user->email ?>
                    </p>
                    <hr>
                    <p>
                        <?= $user->first_name ?>
                    </p>
                    <hr>
                    <p>
                        <?= $user->last_name ?>
                    </p>
                    <hr>
                </div>           
                </div>     
            </div>
        </div>
        <a class='btn btn-success' href="editprofile">Profiel aanpassen</a>
        <a class='btn btn-danger' href="changepassword">Password aanpassen</a>
            <hr>
            <?php
            include_once('../Templates/defaults/footer.php');
            ?>
    </div>
</body>

</html>