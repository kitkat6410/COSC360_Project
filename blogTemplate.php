<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connectiondb.php';
require 'SessionValidation.php';
if (isset($_GET['bid'])) {
    $_SESSION['BID'] = $_GET['bid'];
}
if (!isset($_SESSION['BID'])) {
    echo "Session error: Blog ID not found";
    exit();
}

try {

    $bid = $_SESSION['BID'];
    $stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = :bid");
    $stmt->bindParam(':bid', $bid);
    $stmt->execute();
    $row = $stmt->fetch();

    if (!$row) {
        echo "Database error: Blog not found";
        exit();
    }

    $stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
    $stmt2->bindParam(':bid', $_SESSION['BID']);
    $stmt2->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">


    <title>
        CulinaryCloud | MyBlog
    </title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link rel="stylesheet" href="css/myblog.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script/jquery-3.6.4.min.js"></script>
    <script src="script/blogTemplate.js"></script>
    <style>
    body {
        margin-top: 0;
        background-image: url('<?php echo $row['Thumbnail'] ?>');
        background-size: 25em;

    }
    </style>
    <!-- <style>
  body {
    margin-top: 0;
    padding: 0;
    background-image: url('<?php echo $row['Thumbnail'] ?>');
    background-size: 25em;
    /* background-position: center; */
    background-repeat: repeat;
  }
</style> -->



    </link>
    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>

            <p>Social Media Links</p>
        </div>
        <ul>
            <li><a href="blogs.php">Back to Browse Blogs</a></li>
        </ul>
    </nav>



</head>

<body>
    <header id="blogPage">
        <h1 id=sugar><?php echo ($row['BlogName']) ?></h1>
        <div id="desc">
            <p><?php echo ($row['Description']) ?></p>
            </p>
            <?php   $date = date('Y-m-d\TH:i:sP', strtotime($row['BlogCreated'])); ?>
            <p>Blog owner: <?php echo $row["Username"] ?> <br>
                Blog created: <time datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row['BlogCreated'])) ?></time> </p>
        </div>
    </header>
    <section id="my-page">
        <?php

        while ($row2 = $stmt2->fetch()) {
            $date = date('Y-m-d\TH:i:sP', strtotime($row2['DatePosted']));
            ?>
        <section id="myBlogContainer">

            <article>
                <time datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row2['DatePosted'])) ?></time>
                <p>By: <?php echo $row2['Author'] ?></p>
                <h1><?php echo $row2['BlogTitle'] ?></h1>

                <h2><?php echo $row2['BlogSecondaryTitle'] ?></h2>



                <img class="baking-image" src="<?php echo $row2['Image'] ?>">

                <p><?php echo nl2br($row2['Content']) ?></p>

            </article>
            <!-- comment section -->
            
                <?php if (isset($_SESSION["LoggedIn"]) && $_SESSION['LoggedIn'] == true) { ?>
                    <section id="comment-section">
               <?php     $stmtComment = $pdo->prepare("SELECT * FROM comments WHERE BID = :bid AND PID = :pid") ;
                        $stmtComment->bindParam(':bid', $_SESSION['BID']);
                        $stmtComment->bindParam(':pid', $row2['PID']);
                        $stmtComment->execute();
                        while($rowComment = $stmtComment->fetch()){
                            ?><?php echo "Hi" ?><?php
                        }
               ?>
                <form method="post" action="process_comment.php">

                    <fieldset>
                        <legend>Leave a comment</legend>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <p>
                                        <label for="username">Username:</label>
                                        <br>
                                        <input type="text" id="username" name="username"
                                            value="<?php echo $_SESSION['user_id'] ?>">
                                    </p>
                                    <p>
                                        <label for="title">Title:</label>
                                        <br>
                                        <input type="text" id="title" name="title" size="15">
                                    </p>
                                    <p>
                                        <label for="comment">Comment:</label>
                                        <br>
                                        <input type="text" id="comment" name="comment" size="30">
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="rectangle centered">
                                        <input type="submit" value="Submit" class="rounded">
                                        <input type="reset" value="Reset" class="rounded">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
                </section>
                <?php } ?>
        
        </section>
        <?php } ?>
    </section>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $row['Username']) { ?>
    <button class="rounded" id="show-form">New Post</button>
    <?php } ?>
    <form id="my-form" style="display: none;" method="post" action="validatePost.php" name="createPost"
        onsubmit="return validateForm()" enctype="multipart/form-data">
        <!-- <form method="post" action="validateCreate.php" name="createBlog" id="mainForm" onsubmit="return validateForm()"
        enctype="multipart/form-data"> -->
        <fieldset>
            <legend>Make New Blog Post</legend>
            <table>

                <tr>
                    <td>
                        <p>
                            <label>Title of your blog post:</label>*<br />
                            <input type="text" name="title" size="90" class="required" />
                        </p>
                        <p>
                            <label>Secondary Title of your blog post:</label>*<br />
                            <input type="text" name="secondTitle" size="90" class="required" />
                        </p>
                        <p>
                            <label>Content:</label>*<br />
                            <textarea name="content" rows="5" cols="61" class="required"></textarea>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="box">
                            Select image to upload:*
                            <p></p>
                            <input type="file" name="image2" id="image2">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p></p>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="rectangle">
                            <label style="color: white;">I agree with the terms and conditions*</label>
                            <input type="checkbox" name="agree" class="required">
                        </div>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                        <p id="error-message"></p>
                    </td>
                    <?php
                    // unused code, save for letter. Other error handling that directs back to this page
                    if (isset($_GET['error'])) {
                        switch ($_GET['error']) {
                            case "BlogExists":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"You already have a blog with that name. Please choose another.\";</script>";
                                break;
                            case "NotAnImage":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"The file you chose is not an image. Please choose an image\";</script>";
                                break;
                            case "NoImage":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Please select an image.\";</script>";
                                break;
                            case "InvalidUsername":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Username\";</script>";
                                break;
                            case "Large":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Your image file is too large.\";</script>";
                                break;
                            case "UploadError":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"There was an issue with uploading your chosen image. Please try again.\";</script>";
                                break;
                            case "EmptyFields":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Fields were left empty.\";</script>";
                                break;
                            case "DuplicatePost":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"You already have a title with the same name. Please choose another.\";</script>";
                                break;
                            case "Unknown":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";
                                break;
                            default:
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";



                        }
                    } ?>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="rectangle centered">
                            <input type="submit" value="Submit" id="Submit" class="rounded"> <input type="reset"
                                value="Reset" class="rounded">
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>