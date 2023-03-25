<?php
require 'connectiondb.php';
require 'SessionValidation.php';
$errors = array(); // initialize an empty array to hold any validation errors
// validate the title
if (empty($_POST['title'])) {
    $errors[] = 'Title is required.';
} else if (strlen($_POST['title']) > 90) {
    $errors[] = 'Title must be less than or equal to 90 characters.';
}

// validate the secondTitle
if (strlen($_POST['secondTitle']) > 50) {
    $errors[] = 'Second title must be less than or equal to 50 characters.';
}

// validate the content
if (empty($_POST['content'])) {
    $errors[] = 'Content is required.';
} else if (strlen($_POST['content']) > 2000) {
    $errors[] = 'Content must be less than or equal to 2000 characters.';
}

// validate the image
if (empty($_FILES['image2'])) {
    $errors[] = 'Image is required.';
} else {
    $imageFileType = strtolower(pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION));
    if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
        $errors[] = 'Only JPG, JPEG, PNG, and GIF files are allowed.';
    } else if ($_FILES['image2']['size'] > 10485760) { // 10 MB
        $errors[] = 'Image must be less than or equal to 10 MB.';
    }
 }
if (!empty($errors)) {
    $response = array(
        'success' => false,
        'errors' => $errors
    );
    $_SESSION['response'] = $response;
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
// check for any errors

// $selectStmt = $pdo->prepare("SELECT * FROM blogpost WHERE BlogTitle=:title AND Username=:username");
// $selectStmt->bindParam(':title', $_POST['title']);
// $selectStmt->bindParam(':username', $_SESSION['user_id']);
// $selectStmt->execute();
// $row = $selectStmt->fetch();

// if ($row) {
//     header('Location: blogTemplate.php?error=PostExists');
//     exit();
// }
    $target_dir = "images/";
    $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["image2"]["name"]));
    if (!(move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file))) {
        $errors[] = 'Error uploading image';
    }
    try{
    $input = "INSERT INTO blogpost (Author, BlogTitle, BID, BlogSecondaryTitle, Image, Content) VALUES (:author, :title, :bid, :secondtitle, :image, :content)";
    $content = $pdo->quote($_POST['content']);
    $stmt = $pdo->prepare($input);
    $stmt->bindParam(':author', $_SESSION['user_id']);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':bid', $_SESSION['BID']);
    $stmt->bindParam(':secondtitle', $_POST['secondTitle']);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':content',  $content);
    $stmt->execute();
  
    $response = array(
        'success' => true,
        'message' => 'Form submitted successfully'
    );
    $_SESSION['response'] = $response;
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
    }catch(Exception $e){
        echo  $e;
    }
    ?>