<?php
//get username
require 'SessionValidation.php';
try{
    include ('../connectiondb.php');
    if (isset($_GET['user'])) {
        $_SESSION['USER'] = $_GET['user'];
    }
    if (!isset($_SESSION['USER'])) {
        echo "Session error: username not found";
        exit();
    }

    $input = "UPDATE userinfo SET Status = 0 WHERE Username = :username";
    $stmt = $pdo->prepare($input);
    $stmt->execute(array(':username' => $_GET['user']));

    header("Location: accRequest.php");
    exit();
}catch (Exception $e) {
    error_log($e->getMessage());;
    header('Location: accRequest.php?error=1');
    exit();
}

?>