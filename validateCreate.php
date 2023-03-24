<?php
require 'connectiondb.php';
require 'SessionValidation.php';

// Sanitize input values
$bTitle_input = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$desc = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
$continent = isset($_POST['continent']) && $_POST['continent'] != 'Choose continent' ? filter_var($_POST['continent'], FILTER_SANITIZE_STRING) : NULL;
$cityCountry = filter_var($_POST['cityandcountry'], FILTER_SANITIZE_STRING);
$recipe = isset($_POST['cc1']) ? 1 : 0;
$challenge = isset($_POST['cc2']) ? 1 : 0;
$business = isset($_POST['cc3']) ? 1 : 0;
$review = isset($_POST['cc4']) ? 1 : 0;
$travel = isset($_POST['cc5']) ? 1 : 0;
$collaborate = isset($_POST['cc6']) ? 1 : 0;

// Sanitize uploaded file name
$target_dir = "images/";
$target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename(filter_var($_FILES["thumbnail"]["name"], FILTER_SANITIZE_STRING)));
if (strlen($target_file) === 0) {
    $target_file = null;
    header('Location: signup.php?error=NoImage');
    exit();
}

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
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
    if ($_FILES["thumbnail"]["size"] > 10485760) { //10 MB
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
        if (!(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file))) {
            echo $target_file;
             header('Location: signup.php?error=UploadError');
             exit();
        }
    }
    $username = $_SESSION['user_id'];
    // Check if the blog already exists
$selectStmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BlogName=:blogname AND Username=:username");
$selectStmt->bindParam(':blogname', $bTitle_input);
$selectStmt->bindParam(':username', $username);
$selectStmt->execute();
$row = $selectStmt->fetch();

if ($row) {
    header('Location: create.php?error=BlogExists');
    
    exit();
}
// Insert sanitized input into database
try {
    $input = "INSERT INTO bloginfo (BlogName, Description, Continent, CityandCountry, cc1, cc2, cc3, cc4, cc5, cc6, Username, Thumbnail) VALUES (:blogname, :description, :continent, :cityandcountry, :cc1, :cc2, :cc3, :cc4, :cc5, :cc6, :username, :thumbnail)";
    $stmt = $pdo->prepare($input);

    $stmt->bindParam(':blogname', $bTitle_input);
    $stmt->bindParam(':description', $desc);
    $stmt->bindParam(':continent', $continent);
    $stmt->bindParam(':cityandcountry', $cityCountry);
    $stmt->bindParam(':cc1', $recipe);
    $stmt->bindParam(':cc2', $challenge);
    $stmt->bindParam(':cc3', $business);
    $stmt->bindParam(':cc4', $review);
    $stmt->bindParam(':cc5', $travel);
    $stmt->bindParam(':cc6', $collaborate);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':thumbnail', $target_file);
    $stmt->execute();

    // Upload sanitized file
    move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);

    header("Location: blogTemplate.php");
    exit();

} catch (Exception $e) {
    error_log($e->getMessage());
    echo $e;
}
?>