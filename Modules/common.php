<?php

function getTitle() {
    global $title, $titleSuffix;
    return $title . $titleSuffix;
}

// uploadPicture function that returns the path to the uploaded picture (upload to /public/img/products)

function uploadPicture($picture, $folder)
{
    $target_dir = "img/" . $folder . "/";
    $target_file = $target_dir . basename($picture["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($picture["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        return $target_file;
    }
    // Check file size
    if ($picture["size"] > 500000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($picture["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}