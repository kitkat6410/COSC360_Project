<?php
include('../connectiondb.php');
require 'SessionValidation.php';
$errors = array(); // initialize an empty array to hold any validation errors
if (empty($_POST['content'])) {
    $errors[] = "You cannot post an empty reply.";
} else if (strlen($_POST['content']) > 200) { //replies should be shorter than comments, even if the database can handle it
    $errors[] = "Reply cannot exceed 200 characters.";

}
if (!empty($errors)) {
    $response = array(
        'success' => false,
        'errors' => $errors
    );
    $_SESSION['response'] = $response;
    header('Content-Type: application/json');
    echo json_encode($response);
    print_r($response);
    exit;
}else {
    try {
        $username = $_SESSION['user_id'];
        $reply = htmlspecialchars($_POST['content']);
        // $pid = intval($_POST['pid']);
        // $bid = $_SESSION['BID'];
        // $parent_id = intval($_POST['parent_id']);
        $stmt = $pdo->prepare("INSERT INTO comments (Username, Content, BID, PID, ParentCommentID) VALUES (:username, :content, :bid, :pid, :pCID)");
        $stmt->bindParam(':username', $_SESSION['user_id']);
        $stmt->bindParam(':content', $reply);
        $stmt->bindParam(':bid', $_SESSION['BID']);
        $stmt->bindParam(':pid', $_POST['pid']);
        $stmt->bindParam(':pCID', $_POST['parent_id']);
        $stmt->execute();
        $response = array(
            'success' => true,
            'message' => 'Form submitted successfully'
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }
    catch (Exception $e) {
        echo $e;
        error_log($e->getMessage());
        // header("Location: signup.php?error=Unknown");
        exit();
    }
}

?>