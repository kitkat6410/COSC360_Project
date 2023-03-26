<?php
//get username
require 'SessionValidation.php';
try{
    require 'connectiondb.php';
    $user = $_SESSION['username'];

    $input = "UPDATE userinfo SET Status = 1 WHERE Username = :username";
    $stmt = $pdo->prepare($input);
    $stmt->execute(array(':username' => $user));

    header("Location: activeUser.php");
    exit();
}catch (Exception $e) {
    error_log($e->getMessage());;
    header('Location: activeUser.php?error=1');
    exit();
}

?>