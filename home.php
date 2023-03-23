<!DOCTYPE html>
<html>

<head>
    <?php
require 'SessionValidation.php' ?>
    <title>
        CulinaryCloud | Home
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>
    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>

            <p>Social Media Links</p>
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
            <li><a href="profile.php">Account</a></li>
            <li><a href="index.php">Logout</a></li>
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
            <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>



        </ul>
    </nav>

</head>

<body>

    <header class="third-color">

        <!-- Slideshow container -->
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 4</div>
                <img src="images/food_photo.png">
                <div class="text">Share Your Creations</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 4</div>
                <img src="images/pizza.png">
                <div class="text">Learn Fun Recipes</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 4</div>
                <img src="images/food_together.jpg">
                <div class="text">Create a Community</div>
            </div>
            <div class="mySlides fade">
                <div class="numbertext">4 / 4</div>
                <img src="images/salad.png">
                <div class="text">Participate in Food Challenges</div>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
        </div>
    </header>


    <section class="fourth-color">
        <div class="info">
            <h1>First Steps: Create An Account</h1>
            <p>Welcome to CulinaryCloud! We hope you enjoy your stay. We are a group of food enthusiasts who came
                together
                to create this online community. Once you create an account the Login link at the top right, you can
                start
                to share your creations with your own blog </p>
        </div>
        <div class="info">
            <h1>Share Your Food Passions</h1>

            <p>

                To create your own blog, travel to your account and click create blog! You can then make a title and
                description for your blog and start posting! You can have multiple blogs for different categories or
                just
                one!
            </p>
        </div>
        <div class="info">
            <h1>Find a Community</h1>
            <p>
                To discover blogs you may find interesting, head over the the Browse Blogs page. You can sort public
                blogs
                by category and author. If you know which blog you want, you can search for it directly
            </p>
        </div>

    </section>
    <section id="categories" class=second-color>

        <h1>Categories</h1>
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
    <script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 4000); // Change image every 2 seconds
    }
    </script>
</body>

</html>