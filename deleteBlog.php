<?php
include('../connectiondb.php');
require 'SessionValidation.php';

if (isset($_GET['bid'])) {
    $bid = $_GET['bid'];
    // echo $bid;

    try {
        $stmt = $pdo->prepare("DELETE FROM bloginfo WHERE BID =:bid");
        $stmt->bindParam(':bid', $bid);
        $stmt->execute();
        header("Location: blogs.php");
        exit;

    } catch(Exception $e) {
        echo $e;
        exit();
    }

}else{
    echo "Error: No blog found";
  
}

?>