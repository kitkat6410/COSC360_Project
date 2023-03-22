<?php
try {
    require 'connectiondb.php';
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $target_dir = "images/";
    $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["image"]["name"]));
    if (strlen($target_file) === 0) {
        $target_file = null;
        header('Location: signup.php?error=NoImage');
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
            header('Location: signup.php?error=NotAnImage');
            exit();
        }
    }
    if (!file_exists($target_file)) {


        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
            header('Location: signup.php?error=NotSupported');
            exit();

        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header('Location: signup.php?error="UploadError');
            exit();
            // if everything is ok, try to upload file
        } else {
            if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                header('Location: signup.php?error="UploadError');
                exit();
            }
        }
    }

    $bdate = $_POST['birth'];
    $user_input = $_POST['username'];
    $pass_input = $_POST['password'];

    // validate user input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: signup.php?error=InvalidEmail');
        exit();
    }
    if (!preg_match('/^[A-Za-z0-9_]{6,90}$/', $user_input)) {
        header('Location: signup.php?error=InvalidUsername');
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
    $input2 = "SELECT Username FROM userinfo WHERE Username = :username";
    $stmt2 = $pdo->prepare($input2);
    $stmt2->execute(array(':username' => $user_input));
    $row2 = $stmt2->fetch();
    if ($row2) {
        echo "$user_input";
        header("Location: signup.php?error=DuplicateUsername");
        exit();
    }

    // hash user password
    $hashed_password = password_hash($pass_input, PASSWORD_BCRYPT);

    // use prepared statements
    $input = "INSERT INTO userinfo (Name, Email, BirthDate, ProfileImage, Username, Password) 
            VALUES (:name, :email, :bdate, :image, :username, :password)";
    $stmt = $pdo->prepare($input);
    $stmt->execute(array(':name' => $name, ':email' => $email, ':bdate' => $bdate, ':image' => $target_file, ':username' => $user_input, ':password' => $hashed_password));
    header("Location: login.php");
    exit();
} catch (Exception $e) {
    // log the error and redirect to the signup page
    error_log($e->getMessage());
    header("Location: signup.php?error=Unknown");
    exit();
}
?>