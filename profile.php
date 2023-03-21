<?php
try {
    require 'connectiondb.php';
    $user_input = $_POST['username'];
    $pass_input = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username AND Password = :password");
    $stmt->execute(array(':username' => $user_input, ':password' => $pass_input));
    $row = $stmt->fetch();
    if (!$row) {
   // echo "Username or password is incorrect.";
        // Invalid credentials, redirect back to login page with error message
        header('Location: login.php?error=1');
        exit;

    } 
} catch (Exception $e) {
    echo ($e);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css"></link>
    <link rel="stylesheet" href="css/profile.css">
    </link>
    <nav>
        <div class="site-title">
            <a href="home.html">
                <h1>Culinary Cloud</h1>
                </a>
           
            <p>Social Media Links</p>
        </div>
        <ul>
            <li><a href="blogs.html">Browse Blogs</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="create.html">Create a blog</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>
</head>

<body>
    <h1 class="third-color">Welcome <strong><?php echo $row['Name']?></strong></h1>
    <div class = "profile fourth-color">
    <img src=<?php echo $row['ProfileImage']?> alt="Profile Image">

    <div class="details-container">
    <h2>Account Details</h2>
    <p> <strong>Username: </strong> <?php echo $row['Username']?></p>
	<p><strong>Email: </strong> <?php echo $row['Email']?></p>
	<p><strong>Birth Date: </strong><?php echo $row['BirthDate']?></p>
	<p><strong>Account Created: </strong><?php echo $row['AccountCreated']?></p>
</div>
</div>


	

</body>

</html>