<?php
try {
    include ('../connectiondb.php');

    $target_dir = "images/";
    $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["image"]["name"]));
    // if (strlen($target_file) === 0) {
    //     $target_file = null;
    //     header('Location: signup.php?error=NoImage');
    //     exit();
    // }
    if (empty($_FILES['image'])) {
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


        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
            header('Location: signup.php?error=NotSupported');
            exit();

        }
        // Check file size
        if ($_FILES["image"]["size"] > 10485760) { //10 mb
            $uploadOk = 0;
            header('Location: signup.php?error=Large');
            exit();
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header('Location: signup.php?error=UploadError');
            exit();
            // if everything is ok, try to upload file
        } else {
            if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))) {
                header('Location: signup.php?error=UploadError');
                exit();
            }
        }
   
    // Sanitization
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $bdate = $_POST['birth'];
    $user_input = htmlspecialchars($_POST['username']);
    $pass_input = $_POST['password'];

    // validate user input
    if($name > 90){
        header('Location: signup.php?error=InvalidName');
        exit();
    }
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
        header("Location: signup.php?error=DuplicateUsername");
        exit();
    }

    // hash user password
    $hashed_password = password_hash($pass_input, PASSWORD_BCRYPT);

    // use prepared statements
    $input = "INSERT INTO userinfo (Name, Email, BirthDate, ProfileImage, Username, Password) 
    VALUES (:name, :email, :bdate, :image, :username, :password)";
    $stmt = $pdo->prepare($input);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':bdate', $bdate);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':username', $user_input);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
    header("Location: login.php");
    exit();
} catch (Exception $e) {
    // log the error and redirect to the signup page
    error_log($e->getMessage());
    header("Location: signup.php?error=Unknown");
    exit();
}
?>