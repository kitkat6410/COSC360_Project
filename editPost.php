<?php
include('../connectiondb.php');
require 'SessionValidation.php';
if (!isset($_SESSION['BID'])) {
    echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
    echo "Session error: Blog not found. Possible reason: Logged out of account. Redirecting...";
    exit();
}
if (!isset($_GET['pid'])) {

    echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
    echo "Session error: Post ID not found. Redirecting...";
    exit();
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];



    try {

        $bid = $_SESSION['BID'];
        $stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = :bid");
        $stmt->bindParam(':bid', $bid);
        $stmt->execute();
        $row = $stmt->fetch();
        $stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid AND PID = :pid");
        $stmt2->bindParam(':bid', $bid);
        $stmt2->bindParam(':pid', $pid);
        $stmt2->execute();
        $row2 = $stmt2->fetch();
        if (!$row2) {
            echo "Database error: Post not found";
            exit();
        }

        // $stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
        // $stmt2->bindParam(':bid', $_SESSION['BID']);
        // $stmt2->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <?php
    if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {
        header('Location: Login.php');
    }
    ?>
    <meta charset="utf-8">
    <title>Edit your blog</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script type="text/javascript" src="script/editPost.js"></script>



</head>

<body>
    
    <?php

 ?>
    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $row['Username'] || (isset($_SESSION['isLoggedAdmin']) && $_SESSION['isLoggedAdmin'] == 1)) && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
    <form id="my-form" method="post" action="validateEditPost.php" name="editPost" onsubmit="return validateForm()"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Edit Blog Post: <?php echo $row2['BlogTitle'] ?></legend>
            <table>

                <tr>
                    <td>
                        <p>
                            <input type="text" name="pid" value="<?php echo $pid ?> size=" 90" hidden />
                        <p>
                            <input type="text" name="title" value="<?php echo $row2['BlogTitle'] ?>" size="90" hidden />
                        </p>
                        <p>
                            <label>Secondary Title of your blog post:</label>*<br />
                            <input type="text" name="secondTitle" value="<?php echo $row2['BlogSecondaryTitle'] ?>"
                                size="90" class="required" />
                        </p>
                        <p>
                            <label>Content:</label>*<br />
                            <textarea name="content" rows="5" cols="61"
                                class="required"><?php echo $row2['Content'] ?></textarea>
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
        case "TitleLarge":
            echo "<script>document.getElementById(\"error-message\").innerHTML = \"Title too large. Can be less than or equal to 90 characters\";<script>";
            break;
        case "SecondLarge":
            echo "<script>document.getElementById(\"error-message\").innerHTML = \"Secondary title too large. Can be less than or equal to 50 characters\";<script>";
            break;
        case "ContentLarge":
            echo "<script>document.getElementById(\"error-message\").innerHTML = \"Content too large. Can be less than or equal to 2000 characters\";<script>";
            break;
        case "ErrorPID":
            echo "<script>document.getElementById(\"error-message\").innerHTML = \"Error with finding the post specified\";</script>";
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
</body>
<?php } else {
        print_r($_SESSION);
        print_r($row);
        echo "<div>You do not have permission to edit this blog. Redirecting...</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
    } ?>