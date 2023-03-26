<!DOCTYPE html>
<html>

<head>
    <?php
require 'SessionValidation.php' ?>
    <title>
        CulinaryCloud | Active Users
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/profile.css">

    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>
            <p>Active Users</p>
        </div>
        <ul>
            <li><a href="admin.php">Back</a></li>
            
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
            <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>
        </ul>
    </nav>


</head>

<body>

    
        <h1 class="third-color">Active Users</h1>
    

<?php

    try {
        require 'connectiondb.php';
        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Status = 1");

        if ($result = $stmt->execute(array())) {
        
        while ($row = $stmt->fetch()) {
            $_SESSION['username'] = $row[3];
            
            echo '<div class = "profile fourth-color">
                 <img src="'.$row[6].'" alt="Profile Image">
                 <div class="details-container">
                 <h2>Account Details</h2>
                 <p> <strong>Name: </strong>'.$row[0].'</p>
                 <p> <strong>Username: </strong>'.$row[3].'</p>
                 <p><strong>Email: </strong>'.$row[1].'</p>
                 <p><strong>Account Created: </strong>'.$row[5].'</p>
                 <a href="disable.php" class="linkbutton">Disable User</a>
                 </div>
                 </div>';


        }
    }
        
    } catch (Exception $e) {
        error_log($e->getMessage());;
        header('Location: admin.php?error=1');
        exit();
    }


?>

    

    
    <footer>
        <p>&copy; Copyright 2023 CulinaryCloud</p>

    </footer>
<script>
filterSelection("all");
</script>



</body>

</html>