<?php
ini_set("error_log", "../error.log");
include ('../connectiondb.php');
require 'SessionValidation.php';
if(empty($_POST['pid'])){
    header('Location: editPost.php?error=ErrorPID');
    exit();
}
//prevent against injection attacks
$pid = intval($_POST['pid']);
// validate the title
if (empty($_POST['title'])) {
    header('Location: editPost.php?error=EmptyFields&pid=' . $pid);
    exit();
} else if (strlen($_POST['title']) > 90) {
    header('Location: editPost.php?error=TitleLarge&pid=' . $pid);
    exit();
}

// validate the secondTitle
if(empty($_POST['secondTitle'])){
    header('Location: editPost.php?error=EmptyFields&pid=' . $pid);
    exit();
}
else if (strlen($_POST['secondTitle']) > 50) {
    header('Location: editPost.php?error=SecondLarge&pid=' . $pid);
    exit();
}

// validate the content
if (empty($_POST['content'])) {
    header('Location: editPost.php?error=EmptyFields&pid=' . $pid);
} else if (strlen($_POST['content']) > 2000) {
    header('Location: editPost.php?error=ContentLarge&pid=' . $pid);
    exit();
}

// validate the image
if (empty($_FILES['image2'])) {
    header('Location: editPost.php?error=NoImage&pid=' . $pid);
    exit();
} else {
    $imageFileType = strtolower(pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION));
    if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
        header('Location: editPost.php?error=NotAnImage&pid=' . $pid);
        exit();
    } else if ($_FILES['image2']['size'] > 10485760) { // 10 MB
        header('Location: editPost.php?error=Large&pid=' . $pid);
        exit();
    }
 }

 $target_dir = "images/";
 $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["image2"]["name"]));
 if (!(move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file))) {
    header('Location: editPost.php?error=UploadError&pid=' . $pid);
 }
 $title = htmlspecialchars($_POST['title']);

    try{
        $title = htmlspecialchars($_POST['title']);
    $secondTitle = htmlspecialchars($_POST['secondTitle']);
    $content = htmlspecialchars($_POST['content']);
    $pid = intval($_POST['pid']);

    $input = "UPDATE blogpost SET BlogsecondaryTitle = :secondtitle, Image = :image, Content = :content WHERE PID = :pid";
    $stmt = $pdo->prepare($input);

    $stmt->bindParam(':secondtitle', $secondTitle);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':pid',  $pid);
    $stmt->execute();
  
    header("Location: blogTemplate.php");
    exit();
    }catch(Exception $e){
        error_log($e->getMessage());
        header('Location: editPost.php?error=Unknown&pid=' . $pid);
    }
