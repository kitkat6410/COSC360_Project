<?php
$inactive = 1800; // 30 minutes
ini_set('session.gc_maxlifetime', $inactive);
session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
    // session has expired
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
    // header('Location: login.php'); // redirect to login page
    // exit;
}
?>