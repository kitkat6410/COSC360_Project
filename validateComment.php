<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connectiondb.php';
require 'SessionValidation.php';
$errors = array(); // initialize an empty array to hold any validation errors

// validate content
if (empty($_POST['title'])) {
    $errors[] = 'Title is required.';
} else if (strlen($_POST['title']) > 100) {
    $errors[] = 'Title must be less than or equal to 100 characters.';
}
if (empty($_POST['comment'])) {
    $errors[] = 'Comment is required';
} else if (strlen($_POST['comment']) > 1000) {
    $errors[] = 'Comment must be less than or equal to 1000 characters.';
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
} else {
    try {
        $title = htmlspecialchars($_POST['title']);
        $comment = htmlspecialchars($_POST['comment']);
        // there is no need to do this to $_POST['pid'] because it is coming directly from the database and is not user input
        $pid = intval($_POST['pid']);
        //sanitize with prepared statement
        $stmt = $pdo->prepare("INSERT INTO comments (Username, Title, Content, BID, PID) VALUES (:username, :title, :content, :bid, :pid)");
        $stmt->bindParam(':username', $_SESSION['user_id']);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $_POST['comment']);
        $stmt->bindParam(':bid', $_SESSION['BID']);
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $response = array(
            'success' => true,
            'message' => 'Form submitted successfully'
        );
        // $_SESSION['response'] = $response;
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } catch (Exception $e) {
        echo $e;
    }
}
?>
