<?php
try {
    require 'connectiondb.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_POST['image'];
    $bdate = $_POST['birth'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $input = "INSERT INTO userinfo (Name, Email, BirthDate, ProfileImage, Username, Password) 
            VALUES (:name, :email, :bdate, :image, :username, :password)";
    $stmt = $pdo->prepare($input);
    $stmt->execute(array(':name' => $name, ':email' => $email, ':bdate' => $bdate, ':image' => $image, ':username' => $username, ':password' => $password));
    
    header("Location: login.php");
    exit();
} catch (Exception $e) {
    echo ($e);
}
?>