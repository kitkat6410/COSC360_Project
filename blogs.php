<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <?php
    require 'SessionValidation.php';
    require 'connectiondb.php'; ?>
    <title>
        CulinaryCloud | Browse Blogs
    </title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>
    <script src="script/blogs.js"></script>
    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>
            <p>Social Media Links</p>
        </div>
        <ul>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="about.php">About</a></li>
            <?php if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <li><a href="create.php">Create a blog</a></li>
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


</head>

<body>

    <header id="blogPage" class="third-color">
        <h1 id="browse">Browse Blogs</h1>


    </header>


    <section id="blogBrowse">
        <div id="myBtnContainer" class="fourth-color ">
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

                <a href="blogTemplate.php" onclick="blogClicked('<?php echo $row['BID']; ?>', event); return false;" class="linkbutton">Read More</a>

            </div>
        </div>
        <?php } ?>
        <!-- <div class="blogPrev filterDiv Food-Challenges fourth-color">
            <figure>
                <img src="images/food-daredevil.png" alt="" />

            </figure>
            <div>
                <h1>Food Daredevil</h1>
                <p>Welcome to Food Daredevil, the ultimate destination for food lovers and thrill-seekers! Join me on my
                    culinary adventures as I take on the most outrageous food challenges and push my taste buds to the
                    limit. From giant burgers to spicy wings to bizarre culinary creations, I fearlessly try it all and
                    report back with humor, honesty, and a healthy dose of sarcasm. Whether you're a foodie looking for
                    a good laugh or a fellow daredevil looking for inspiration, this is the blog for you. Let's eat!</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Restaurant-Reviews Travel-Blogs fourth-color">
            <figure>
                <img src="images/dining-destinations.png" alt="" />


            </figure>
            <div>
                <h1>Dining Destinations</h1>
                <p>Welcome to Dining Destinations, where we take you on a journey to explore the world's best culinary
                    experiences. From the busy streets of Tokyo to the tranquil vineyards of Tuscany, we travel the
                    globe to discover hidden gems and popular hotspots that are worth a visit. Our team of food critics
                    and writers provide honest, unbiased reviews and recommendations, giving you an inside look at the
                    food, atmosphere, and service of each restaurant we visit. Join us as we explore new cultures,
                    cuisines, and flavors, and uncover the best dining destinations around the world.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Food-Challenges Collaborate fourth-color">
            <figure>
                <img src="images/vegan-foodie-friends.png" alt="" />


            </figure>
            <div>
                <h1>Vegan Foodie Friends</h1>
                <p>Welcome to Vegan Foodie Friends, where we celebrate the joy of plant-based eating with food
                    challenges and collaborations. Our mission is to explore the delicious world of vegan cuisine and
                    share our experiences with you. From hearty comfort food to creative gourmet dishes, we're always on
                    the lookout for new and exciting flavors to try. But we don't just eat - we also collaborate with
                    other bloggers and chefs to share their unique perspectives and recipes. Join our community of vegan
                    foodie friends and discover the endless possibilities of plant-based eating!</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Food-Challenges Recipes fourth-color">
            <figure>
                <img src="images/recipe-revolt.jpg" alt="" />


            </figure>
            <div>
                <h1>Recipe Revolt</h1>
                <p>Welcome to Recipe Revolt, where we take on food challenges and share our favorite recipes with you.
                    Our team of culinary enthusiasts are always looking for new and exciting food challenges to take on,
                    whether it's a spicy noodle challenge or a massive burger challenge. We document our experiences and
                    share tips and tricks on how to tackle these challenges. But we don't just stop there - we also
                    share our favorite recipes that we've perfected in our own kitchens. From appetizers to desserts,
                    we've got you covered. Join us in the Recipe Rumble and discover the thrill of culinary conquests!
                </p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Collaborate fourth-color">
            <figure>
                <img src="images/food-for-all.jpg" alt="" />


            </figure>
            <div>
                <h1>Food for All</h1>
                <p>Welcome to Food for All, where we believe that everyone deserves access to delicious, healthy food.
                    Our mission is to collaborate with our local community and food banks to provide nutritious meals
                    for those in need. Through our blog, we share recipes, tips, and tricks for cooking on a budget and
                    reducing food waste. We also feature stories of individuals and organizations making a difference in
                    the fight against hunger. Join us in our journey towards a world where no one goes hungry, and
                    everyone has access to good food. Together, we can create a community where food is for all.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Recipes fourth-color">
            <figure>
                <img src="images/northern-nibbles.png" alt="" />


            </figure>
            <div>
                <h1>Northern Nibbles</h1>
                <p>Welcome to Northern Nibbles, where we share the best of Canadian cuisine. Our blog is dedicated to
                    bringing you authentic Canadian recipes, from classic dishes like poutine and maple-glazed salmon,
                    to modern twists on traditional favorites. We believe that food is an essential part of Canadian
                    culture, and we are passionate about sharing it with the world. Our recipes are made with fresh,
                    locally-sourced ingredients, and we love to showcase the diverse flavors and culinary traditions of
                    our country. Whether you're a seasoned home cook or just getting started, our blog has something for
                    everyone. Join us on a culinary journey across Canada with Northern Nibbles.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Recipes fourth-color">
            <figure>
                <img src="images/simple-eats.png" alt="" />


            </figure>
            <div>
                <h1>Simple Eats</h1>
                <p>Welcome to Simple Eats, where we believe that cooking delicious meals should be easy and accessible
                    to everyone. Our blog is dedicated to sharing simple, easy-to-follow recipes that are perfect for
                    beginners. We know that starting out in the kitchen can be intimidating, so we're here to help you
                    build your confidence and master the basics. From quick weeknight dinners to weekend brunches, we've
                    got you covered with recipes that are both delicious and stress-free. Our focus is on using fresh,
                    whole ingredients that are easy to find and affordable. Join us on a journey towards effortless
                    cooking and simple eats that the whole family will love.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Travel-Blogs fourth-color">
            <figure>
                <img src="images/the-hungry-traveler.png" alt="" />


            </figure>
            <div>
                <h1>The Hungry Traveler</h1>
                <p>Welcome to The Hungry Traveler, where we believe that food is the best way to explore the world. Our
                    blog is dedicated to sharing our adventures in culinary exploration, as we travel the globe in
                    search of delicious and authentic dishes. From street food in Southeast Asia to haute cuisine in
                    Europe, we're always on the lookout for the next great culinary discovery. But we're not just about
                    the food – we're passionate about the stories and people behind the dishes. We love to connect with
                    locals, chefs, and food enthusiasts to learn about the history and culture of each destination. Join
                    us on a journey towards flavor-filled travels, as we satisfy our wanderlust and our appetites, one
                    bite at a time.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Business fourth-color">
            <figure>
                <img src="images/chef-table.png" alt="" />



            </figure>
            <div>
                <h1>The Chef's Table</h1>
                <p>Welcome to The Chef's Table, a blog dedicated to the art and science of cuisine. Our blog is
                    inspired by the tradition of the chef's table – a place where culinary masters gather to craft and
                    enjoy their creations. Through our blog, we aim to share that same level of culinary excellence with
                    our readers, bringing you inside the world of our kitchen and beyond. From farm to table, we share
                    our passion for fresh, seasonal ingredients and innovative cooking techniques. Our chefs will share
                    their tips and tricks, while our sommeliers and mixologists will guide you through the world of wine
                    and spirits. But we're not just about the food and drink – we're dedicated to creating a complete
                    dining experience. Join us at The Chef's Table as we explore the world of gastronomy and savor the
                    finer things in life.</p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>
        <div class="blogPrev filterDiv Business Recipes fourth-color">
            <figure>
                <img src="images/savory-secrets.png" alt="" />


            </figure>
            <div>
                <h1>Savory Secrets</h1>
                <p>Welcome to Savory Secrets, your go-to source for tantalizing recipes and culinary inspiration. Our
                    blog is dedicated to sharing the savory secrets of the world's most talented chefs, home cooks, and
                    food enthusiasts. We believe that cooking is an art form, and we're passionate about helping our
                    readers create dishes that are as delicious as they are beautiful.

                    At Savory Secrets, you'll find a wealth of recipes, cooking tips, and culinary hacks that will
                    elevate your kitchen skills to the next level. Whether you're an experienced chef or a novice cook,
                    our blog has something to offer. From mouthwatering appetizers to decadent desserts, our recipes are
                    sure to impress. We're also committed to providing a diverse range of recipes that cater to
                    different dietary needs and preferences, including vegetarian, vegan, gluten-free, and more.
                </p>

                <a href="#" class="linkbutton">Read More</a>

            </div>
        </div>

    </section> -->

    <footer>
        <p>&copy; Copyright 2023 CulinaryCloud</p>

    </footer>
    <script>
    filterSelection("all");
    </script>



</body>

</html>