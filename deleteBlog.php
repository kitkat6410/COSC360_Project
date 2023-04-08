<?php
include('../connectiondb.php');
require 'SessionValidation.php';

if (isset($_SESSION['BID'])) {
    $bid = $_SESSION['BID'];
    // echo $bid;

    try {
        $stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = :bid");
        $stmt->bindParam(':bid', $bid);
        $stmt->execute();
        $row = $stmt->fetch();    
        // this if statement added to avoid people from being able to put in the url themselves
        if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $row['Username'] || (isset($_SESSION['isLoggedAdmin']) && $_SESSION['isLoggedAdmin'] == 1)) && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { 
        $stmt = $pdo->prepare("DELETE FROM bloginfo WHERE BID =:bid");
        $stmt->bindParam(':bid', $bid);
        $stmt->execute();
        $numRows = $stmt->rowCount();
        if($numRows > 0){
        // Set a success message
        $message = "Blog successfully deleted.";
        }else{
            $message = "Error: No blog found.";
        }
    
 


    }
    else{
        $message = "You do not have permission to delete this blog.";
    }

    } catch(Exception $e) {
        echo $e;
        exit();
    }

}else{
    $message = "Error: No blog found";
}
echo "<div>$message Redirecting...</div>";
echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
?>