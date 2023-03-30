<!DOCTYPE html>
<html>

<head>
    <?php
require 'SessionValidation.php' ?>
    <title>
        CulinaryCloud | Account Requests
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/profile.css">

 


</head>

<body>
<nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>
            <p>Profile requests</p>
        </div>
        <ul>
            <li><a href="admin.php">Back</a></li>
            
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
            <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>
        </ul>
    </nav>
    <script>
        function blogClicked(user, event) {
        event.preventDefault();
        console.log(user);
        window.location.href = "enable.php?user=" + user;
        }
    </script>

</head>

<body>

    
        <h1 class="third-color">Profile requests</h1>
    

<?php

    try {
        include ('../connectiondb.php');
        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Status = 0 AND isAdmin = 0");

        if ($result = $stmt->execute(array())) {

        while ($row = $stmt->fetch()) {
?>
            
                <div class = "profile fourth-color">
                 <img src="<?php echo $row[6]; ?>" alt="Profile Image">
                 <div class="details-container">
                 <h2>Account Details</h2>
                 <p> <strong>Name: </strong><?php echo $row[0]; ?></p>
                 <p> <strong>Username: </strong><?php echo $row[3]; ?></p>
                 <p><strong>Email: </strong><?php echo $row[1]; ?></p>
                 <p><strong>Account Created: </strong><?php echo $row[5]; ?></p>
                 <a href="enable.php" class="linkbutton" onclick="blogClicked('<?php echo $row[3]; ?>', event); return false;">Enable User</a>
                 </div>
                 </div>

<?php
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