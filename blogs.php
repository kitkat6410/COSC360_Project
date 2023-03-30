<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <?php
    require 'SessionValidation.php';
    include ('../connectiondb.php'); ?>
    <title>
        CulinaryCloud | Browse Blogs
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>
    <script src="script/blogs.js"></script>
 


</head>

<body>
<nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>
            <p>Browse Blogs</p>
        </div>
        <ul>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="about.php">About</a></li>
            <?php if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <?php  if(isset($_SESSION['Status']) && $_SESSION['Status'] == 1){ ?>
                <li><a href="create.php">Create a blog</a></li>  
<?php } ?>
                <?php if (isset($_SESSION['isLoggedAdmin'])) {
                    ?>
                    <li><a href="adminProfile.php">Account</a></li>
                <?php } else { ?>
                    <li><a href="profile.php">Account</a></li>

                <?php } ?>
                <li><a href="index.php">Logout</a></li>
            <?php } ?>
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
                <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>
        </ul>
    </nav>

    <header id="blogPage" class="third-color">
        <h1 id="browse">Browse Blogs</h1>
    </header>

    <div class="fourth-color" style="margin-top: 30px;" id="blogPage">
        <h2 id="action" style="padding-left: 30px;">Search Blogs (by name): </h2>
        
        <form method="Post" action="blogs.php" style="padding-left: 30px;">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
            <p>(Re-click the search button to reset the filter)</p>
        </form>
    </div>

    <section id="blogBrowse" style="margin-top: 0px;">
        <div id="myBtnContainer" class="third-color">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <button class="btn" onclick="filterSelection('Recipes')"> Recipes</button>
            <!--cc1 -->
            <button class="btn" onclick="filterSelection('Food-Challenges')"> Food Challenges</button>
            <!--cc2 -->
            <button class="btn" onclick="filterSelection('Business')"> Business</button>
            <button class="btn" onclick="filterSelection('Restaurant-Reviews')"> Restaurant Reviews</button>
            <button class="btn" onclick="filterSelection('Travel-Blogs')"> Travel Blogs</button>
            <button class="btn" onclick="filterSelection('Collaborate')"> Collaboration & Community</button>
        </div>

        <?php
        if(isset($_POST['search'])){
            $search = "%".$_POST['search']."%";

            try{
                $input = "SELECT * FROM bloginfo WHERE BlogName LIKE :search";
                $stmt = $pdo->prepare($input);
                $stmt->execute(array(':search' => $search));
               
                }catch(Exception $e){
                echo $e;
                }
                while($row=$stmt->fetch()){
                    $classes = "";
                    $first = true;
                    if($row['cc1'] == 1){
                        $classes .= "Recipes";
        
                    }
                    if($row['cc2'] == 1){
                        $classes .= "Food-Challenges";
                    }
                    if($row['cc3'] == 1){
                        $classes .="Business";
                    }
                    if($row['cc4'] == 1){
                        $classes .="Restaurant-Reviews";
                    }
                    if($row['cc5'] == 1){
                        $classes .= "Travel-Blogs";
                    }
                    if($row['cc6'] == 1){
                        $classes .= "Collaborate";
                    }
                ?>
                <div class=" blogPrev filterDiv <?php echo $classes ?> fourth-color ">
                    <figure>
                        <img src="<?php echo $row['Thumbnail'] ?>" alt="Thumbnail" />
            
                    </figure>
                    <div>
                        <h1><?php echo $row['BlogName'] ?></h1>
                        <p><?php echo $row['Description'] ?></p>
        
                        <a href="blogTemplate.php" onclick="blogClicked('<?php echo $row['BID']; ?>', event); return false;" class="linkbutton2">Read More</a>
        
                    </div>
                </div>
                <?php } 
        }else{
            try{
                $input = "SELECT * FROM bloginfo";
                $stmt = $pdo->prepare($input);
                $stmt->execute();
               
          
                }catch(Exception $e){
                echo $e;
                }
                while($row=$stmt->fetch()){
                    $classes = "";
                    $first = true;
                    if($row['cc1'] == 1){
                        $classes .= "Recipes";
        
                    }
                    if($row['cc2'] == 1){
                        $classes .= "Food-Challenges";
                    }
                    if($row['cc3'] == 1){
                        $classes .="Business";
                    }
                    if($row['cc4'] == 1){
                        $classes .="Restaurant-Reviews";
                    }
                    if($row['cc5'] == 1){
                        $classes .= "Travel-Blogs";
                    }
                    if($row['cc6'] == 1){
                        $classes .= "Collaborate";
                    }
                ?>
                <div class=" blogPrev filterDiv <?php echo $classes ?> fourth-color ">
                    <figure>
                        <img src="<?php echo $row['Thumbnail'] ?>" alt="Thumbnail" />
            
                    </figure>
                    <div>
                        <h1><?php echo $row['BlogName'] ?></h1>
                        <p><?php echo $row['Description'] ?></p>
        
                        <a href="blogTemplate.php" onclick="blogClicked('<?php echo $row['BID']; ?>', event); return false;" class="linkbutton2">Read More</a>
        
                    </div>
                </div>
                <?php } 
        }
        ?>


    <footer>
        <p>&copy; Copyright 2023 CulinaryCloud</p>

    </footer>
    <script>
    filterSelection("all");
    </script>
</section>


</body>

</html>