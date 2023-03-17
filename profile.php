<?php
try {
    require 'connectiondb.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;
    $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username AND Password = :password");
    $stmt->execute(array(':username' => $username, ':password' => $password));
    $row = $stmt->fetch();
    if ($row) {
        echo $row['Username'];
        echo $row['Password'];
    } else {
        // echo "Username or password is incorrect.";
        // Invalid credentials, redirect back to login page with error message
        header('Location: login.php?error=1');
        exit;
    }
} catch (Exception $e) {
    echo ($e);
}