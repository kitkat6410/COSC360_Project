<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<?php
    require 'SessionValidation.php';
    include ('../connectiondb.php');
    ?>
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
        
    </header>

    
    <section id="aboutPage" class="fourth-color">
        <h1 id="browse" style="font-size: 3em; color: black;">Website Information:</h1>
        <?php
        try{
            $stmt1 = $pdo->prepare("SELECT COUNT(*) AS count FROM userinfo WHERE Status=1");
            $stmt1->execute(); // Execute the prepared statement
            $result1 = $stmt1->fetch(); // Fetch the result as an associative array

            if ($result1 !== false) {
                $count = $result1['count'];
            } else {
                echo "Error: Failed to fetch result.";
            }

            $stmt2 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo");
            $stmt2->execute(); // Execute the prepared statement
            $result2 = $stmt2->fetch();

            if ($result2 !== false) {
                $count2 = $result2['count'];
            } else {
                echo "Error: Failed to fetch result2.";
            }
        
        }catch (Exception $e) {
            error_log($e->getMessage());;
            header('Location: admin.php?error=1');
            exit();
        }
        echo '<div style="padding: 2em;">
            <h1>Number of active users (including admins): '.$count.'</h1>
            <h1>Number of public blogs: '.$count2.'</h1>';

            try{
                $stmt1 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc1=1");
                $stmt1->execute(); // Execute the prepared statement
                $result1 = $stmt1->fetch(); // Fetch the result as an associative array
                $num1 = $result1['count'];
    
                $stmt2 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc2=1");
                $stmt2->execute(); // Execute the prepared statement
                $result2 = $stmt2->fetch();
                $num2 = $result2['count'];

                $stmt3 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc3=1");
                $stmt3->execute(); // Execute the prepared statement
                $result3 = $stmt3->fetch();
                $num3 = $result3['count'];

                $stmt4 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc4=1");
                $stmt4->execute(); // Execute the prepared statement
                $result4 = $stmt4->fetch();
                $num4 = $result4['count'];

                $stmt5 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc5=1");
                $stmt5->execute(); // Execute the prepared statement
                $result5 = $stmt5->fetch();
                $num5 = $result5['count'];

                $stmt6 = $pdo->prepare("SELECT COUNT(*) AS count FROM bloginfo WHERE cc6=1");
                $stmt6->execute(); // Execute the prepared statement
                $result6 = $stmt6->fetch();
                $num6 = $result6['count'];

                $array = array(
                    'num1' => $num1,
                    'num2' => $num2,
                    'num3' => $num3,
                    'num4' => $num4,
                    'num5' => $num5,
                    'num6' => $num6
                );
                $maxKey = array_search(max($array), $array);
                if($maxKey == 'num1'){
                    $cat = 'Recipes';
                }else if($maxKey == 'num2'){
                    $cat = 'Food challenges';
                }else if($maxKey == 'num3'){
                    $cat = 'Business/marketing';
                }else if($maxKey == 'num4'){
                    $cat = 'Restaurant reviews';
                }else if($maxKey == 'num5'){
                    $cat = 'Travel vlogs';
                }else if($maxKey == 'num6'){
                    $cat = 'Collaborate';
                }

            }catch (Exception $e) {
                error_log($e->getMessage());;
                header('Location: admin.php?error=1');
                exit();
            }

        echo '<h1>Most popular category: '.$cat.'</h1>
            <h1 id="browse" style="font-size: 3em; color: black; padding-top: 0.5em;">Visual Summary:</h1>
            <h1>Number of blogs per category.</h1>';

            
            echo "<div>
                    <canvas id='myChart'></canvas>
                    </div>
                    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>

                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                            labels: ['Recipes', 'Food challenges', 'Business/marketing', 'Restaurant reviews', 'Travel vlogs', 'Collaborate'],
                            datasets: [{
                                label: '# of Blogs',
                                data: [".$num1.", ".$num2.", ".$num3.", ".$num4.", ".$num5.", ".$num6."],
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgb(255, 205, 86)'
                                  ]
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            }
                        });
                    </script>
                    
                </div>";
        ?>

    </section>
    <section id="categories"class=second-color>

        <h1>Specific categories:</h1>
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