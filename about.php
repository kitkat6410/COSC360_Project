<!DOCTYPE html>
<html>

<head>
<?php if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>
    <title>
        CulinaryCloud | About
    </title>
    <link rel="stylesheet" href="css/reset.css"></link>
    <link rel="stylesheet" href="css/styles.css"></link>
    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>
            <p>Social Media Links</p>
        </div>
        <ul>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="home.php">Home</a></li>
            <?php
            if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {?>
                <li><a href="login.php">Login</a></li>
  
           <?php }else{?>
                <li><a href="profile.php">Account</a></li>
                <li><a href="index.php">Logout</a></li>
         <?php  }?>
         <li><a href="adminLogin.php">Admin</a></li>
    
        </ul>
    </nav>
</head>

<body>
    <header id="aboutPage" class="third-color">
        <h1 id="browse">About Us</h1>
    </header>

    <div class="faq fourth-color">
        <h2>
            CulinaryCloud is a platform for food enthusiasts to come together and share their love for food, cooking and culinary experiences. 
            </h2>
            <h2>
            This website features a variety of blog categories for users to explore and engage with, including recipes, food challenges, business/marketing, restaurant reviews, travel vlogs, collaborations, and cuisine specific blogs. 
            With a focus on community and collaboration, CulinaryCloud is the ultimate destination for food lovers to connect, share and learn.
        </h2>
    </div>
    
    <div>
        <h1 class="third-color" id="aboutPage" >FAQs</h1>
    </div>
    
    
        <div class="faq fourth-color">
            <h2>
                Q: How do I create a blog on this website?
            </h2>
            <h2 class="border">
                A: To create a blog on this website, you'll need to create an account first. Once you've created an account, you can log in and navigate to the "Create a Blog" page. From there, you'll be able to enter the title and content for your blog post, upload photos, and publish it to the website.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: How often do I need to update my blog?
            </h2>
            <h2 class="border">
                A: Whenever you like! There isn't a hard deadline on how often you should post but you need to bare in mind that frequently updated blogs get noticed by more viewers.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: Is there a limit to how many blog posts I can create?
            </h2>
            <h2 class="border">
                A: No, there is no limit to how many blog posts you can create.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: Can I collaborate with other bloggers on this website?
            </h2>
            <h2 class="border">
                A: Yes, you can collaborate with other bloggers on this website by reaching out to them directly and discussing possible collaborations. You can also join the website's forum or social media pages to connect with other bloggers.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: Can I promote my own products or services in my blog posts?
            </h2>
            <h2 class="border">
                A: Yes, you can promote your own products or services in your blog posts, as long as they are related to the topic of your blog and comply with our terms and conditions. However, please note that we do not allow any spammy or irrelevant content.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: Do I need to be a chef to create a food blog?
            </h2>
            <h2 class="border">
                A: Absolutely not! Anyone can create a food blog as long as they wish to be part of the community.
            </h2>
        </div>
        <div class="faq fourth-color">
            <h2>
                Q: Do I need to be a chef to create a food blog?
            </h2>
            <h2 class="border">
                A: Absolutely not! Anyone can create a food blog as long as they wish to be part of the community.
            </h2>
        </div>
    
</body>

</html>