<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<?php
    require 'SessionValidation.php' ?>
    <title>
        CulinaryCloud | Admin
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>


</head>

<body>
<nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
                </a>
           
            <p>Administrator Access</p>
        </div>
        
        <ul>
            <?php
        if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {
            header('Location: index.php');
            exit;

        } ?>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="create.php">Create a blog</a></li>
            <li><a href="adminProfile.php">Account</a></li>
            <li><a href="index.php">Logout</a></li>
            <?php
            if (!isset($_SESSION['isLoggedAdmin']) && $_SESSION['isAdmin'] != 1) {
            header('Location: adminLogin.php?error=unAuthorized');
            } 
            else if(!isset($_SESSION['isLoggedAdmin'])){
                header('Location: adminLogin.php?error=notLoggedIn');
            }
                ?>



        </ul>
    </nav>

    <header id="aboutPage" class="third-color">
        <h1 id="browse" style="font-size: 3em; padding-bottom: 0.5em;">Quick Access Links:</h1>
        <a href="userProfile.php"><h1 id="browse">User Profiles</h1></a>
        <a href="accRequest.php"><h1 id="browse">Account Requests</h1></a>
        <a href="activeUser.php"><h1 id="browse">Active Users</h1></a>
        <a href="#"><h1 id="browse">Edit/delete posts</h1></a>
        <a href="#"><h1 id="browse">Edit/Delete Blogs</h1></a>
    </header>

    
    <section class="fourth-color">
        <h1 id="browse" style="font-size: 3em; color: black;">Website Information:</h1>
        <div style="width: 100%; padding: 2em;">
            <h1>Number of active users: 72</h1>
            <h1>Number of public blogs: 107</h1>
            <h1>Number of site visits in the past week: 143</h1>
            <h1>Most popular category: Business and Marketing</h1>

            <h1 id="browse" style="font-size: 3em; color: black; padding-top: 0.5em;">Visual Summary:</h1>
            <figure style="padding: 2em;">
                <img src="images/stat2.png" height="350px">
            </figure>
            <figure style="padding: 2em;">
                <img src="images/stat3.png" height="350px">
            </figure>
            <figure style="display: block; padding: 2em; margin: auto;">
                <img src="images/stat1.png" height="350px">
            </figure>
        </div>
        

    </section>
    <section id="categories"class=second-color>

        <h1>Information regarding specific categories:</h1>
        <figure id="first">
            <img src="images/recipe.jpg">
            <figcaption>
                Recipes
            </figcaption>
        </figure>
        <figure>
            <img src="images/food_challenge.jpg">
            <figcaption>
                Food Challenges
            </figcaption>
        </figure>
        <figure>
            <img src="images/business_food.jpeg">
            <figcaption>
                Promote Business
            </figcaption>
        </figure>
        <figure>
            <img src="images/review.jpg">
            <figcaption>
                Food Reviews
            </figcaption>
        </figure>
        <figure>
            <img src="images/travel.jpg">
            <figcaption>
                Travel Blogs
            </figcaption>
        </figure>
        <figure>
            <img src="images/community.jpg">
            <figcaption>
                Community
            </figcaption>
        </figure>
    </section>

    <footer>
        <p>&copy; Copyright 2023 CulinaryCloud</p>

    </footer>
    
</body>

</html>