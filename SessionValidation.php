<?php
$inactive = 3600; // 1 hour
ini_set('session.gc_maxlifetime', $inactive);
session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
    // session has expired
    $keepVariable = 'BID'; // replace with the name of the variable you want to keep

    foreach ($_SESSION as $key => $value) {
        if ($key != $keepVariable) {
            unset($_SESSION[$key]);
        }
    }
    // session_unset();     // unset $_SESSION variable for this page
// session_destroy();

}
?>