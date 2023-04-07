<?php
include('../connectiondb.php');
require 'SessionValidation.php';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    try {
        $stmt = $pdo->prepare("DELETE FROM blogpost WHERE PID =:pid");
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $response = array(
            'success' => true,
            'message' => 'Form submitted successfully'

        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } catch (Exception $e) {
        $response = array(
            'success' => false,
            'errors' => "An error occurred when trying to delete your post: " . $e->getMessage()
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {

    $response = array(
        'success' => false,
        'errors' => "An error occurred when trying to delete your post: PID parameter not set."
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

}
?>