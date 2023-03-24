<?php
require 'SessionValidation.php';
try {
    require 'connectiondb.php';

    $target_dir = "images/";
    $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["image"]["name"]));
    if (strlen($target_file) === 0) {
        $target_file = null;
        header('Location: edit.php?error=NoImage');
        exit();
    }

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            header('Location: edit.php?error=NotAnImage');
            exit();
        }
    }
    if (!file_exists($target_file)) {


        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
            header('Location: edit.php?error=NotSupported');
            exit();

        }
        // Check file size
        if ($_FILES["image"]["size"] > 10000000) { //10 mb
            $uploadOk = 0;
            header('Location: edit.php?error=Large');
            exit();
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header('Location: edit.php?error=UploadError');
            exit();
            // if everything is ok, try to upload file
        } else {
            if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))) {
                header('Location: edit.php?error=UploadError');
                exit();
            }
        }
    }
    else{
        header('Location: edit.php?error=DoesNotExist');
        exit();
    }
    // Sanitization
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $bdate = $_POST['birth'];
    $pass_input = $_POST['password'];

    // validate user input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: signup.php?error=InvalidEmail');
        exit();
    }
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])(?!.*\s).{8,}$/', $pass_input)) {
        header('Location: signup.php?error=InvalidPassword');
        exit();
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $bdate)) {
        header('Location: signup.php?error=InvalidBirthdate');
        exit();
    }
    // hash user password
    $hashed_password = password_hash($pass_input, PASSWORD_BCRYPT);
    $_SESSION['pass_id'] = $hashed_password;
    // username
    $user_input = $_SESSION['user_id'];
    // use prepared statements
    $input = "UPDATE userinfo SET Name = :name, Email = :email, BirthDate = :bdate, ProfileImage = :image, Password = :password WHERE Username = :username";
    $stmt = $pdo->prepare($input);
    $stmt->execute(array(':name' => $name, ':email' => $email, ':bdate' => $bdate, ':image' => $target_file, ':password' => $hashed_password, ':username' => $user_input));
    if($_SESSION['isAdmin']){
        $stmt2 = $pdo->prepare("UPDATE admininfo SET Password = :password WHERE Username = :username");
        $stmt2->execute(array(':password' => $hashed_password, ':username' => $user_input));
    }
    header("Location: profile.php");
    exit();
} catch (Exception $e) {
    // log the error and redirect to the signup page
    error_log($e->getMessage());
    header("Location: edit.php?error=Unknown");
    exit();
}
?>