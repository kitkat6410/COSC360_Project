<!DOCTYPE html>
<html>

<head>
    <?php
require 'SessionValidation.php';
include ('../connectiondb.php'); ?>
    <title>
        CulinaryCloud | User Profiles
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
            <p>User Profiles</p>
        </div>
        <ul>
            <li><a href="admin.php">Back</a></li>
            
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
            <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>
        </ul>
    </nav>


    
        <h1 class="third-color">User Profiles</h1>
    

    <div class="fourth-color" style="margin-top: 30px;">
        <h2 id="action">Search User (by name, username or email): </h2>
        
        <form method="Post" action="userProfile.php">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

<?php
if(isset($_POST['search'])){
    $search = "%".$_POST['search']."%";
    
    try {
        
        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Name LIKE :search1 OR Username LIKE :search2 OR Email LIKE :search3");
        $stmt->bindParam(':search1', $search);
        $stmt->bindParam(':search2', $search);
        $stmt->bindParam(':search3', $search);
        $stmt->execute();
        
        while ($row = $stmt->fetch()) {
            
            echo '<div class = "profile fourth-color">
                 <img src="'.$row[6].'" alt="Profile Image">
                 <div class="details-container">
                 <h2>Account Details</h2>
                 <p> <strong>Name: </strong>'.$row[0].'</p>
                 <p> <strong>Username: </strong>'.$row[3].'</p>
                 <p><strong>Email: </strong>'.$row[1].'</p>
                 <p><strong>Account Created: </strong>'.$row[5].'</p>
                 </div>
                 </div>';


        }
    
        
    } catch (Exception $e) {
        error_log($e->getMessage());;
        header('Location: admin.php?error=1');
        exit();
    }
}
else{
    try {
        $stmt = $pdo->prepare("SELECT * FROM userinfo");

        if ($result = $stmt->execute(array())) {
        
        while ($row = $stmt->fetch()) {
            
            echo '<div class = "profile fourth-color">
                 <img src="'.$row[6].'" alt="Profile Image">
                 <div class="details-container">
                 <h2>Account Details</h2>
                 <p> <strong>Name: </strong>'.$row[0].'</p>
                 <p> <strong>Username: </strong>'.$row[3].'</p>
                 <p><strong>Email: </strong>'.$row[1].'</p>
                 <p><strong>Account Created: </strong>'.$row[5].'</p>
                 </div>
                 </div>';


        }
    }
        
    } catch (Exception $e) {
        error_log($e->getMessage());;
        header('Location: admin.php?error=1');
        exit();
    }
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