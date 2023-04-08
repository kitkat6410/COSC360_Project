<?php
include('../connectiondb.php');
require 'SessionValidation.php';
try{
    

    $bid = $_SESSION['BID'];
    $stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = :bid");
    $stmt->bindParam(':bid', $bid);
    $stmt->execute();
    $row = $stmt->fetch();
    if (!$row) {
        echo "Database error: Blog not found";
        exit();
    }
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
    if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $row['Username'] || (isset($_SESSION['isLoggedAdmin']) && $_SESSION['isLoggedAdmin'] == 1)) && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) {  

$cc1 = ($row['cc1'] == 1) ? "checked" : "";
$cc2 = ($row['cc2'] == 1) ? "checked" : "";
$cc3 = ($row['cc3'] == 1) ? "checked" : "";
$cc4 = ($row['cc4'] == 1) ? "checked" : "";
$cc5 = ($row['cc5'] == 1) ? "checked" : "";
$cc6 = ($row['cc6'] == 1) ? "checked" : "";
$op1 = ($row['Continent'] == 'Africa') ? 'selected' : '';
$op2 = ($row['Continent'] == 'Asia') ? 'selected' : '';
$op3 = ($row['Continent'] == 'Europe') ? 'selected' : '';
$op4 = ($row['Continent'] == 'North America') ? 'selected' : '';
$op5 = ($row['Continent'] == 'South America') ? 'selected' : '';
$op6 = ($row['Continent'] == 'Australia') ? 'selected' : '';
$op7 = ($row['Continent'] == 'Antartica') ? 'selected' : '';



?>

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
    <script type="text/javascript" src="script/editBlog.js"></script>



</head>
<nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>

            <p>Edit Your Blog Page</p>
        </div>
        <ul>
            <li><a href="home.php">Back</a></li>

        </ul>
    </nav>

<body>
    <form method="post" action="validateEditBlog.php" name="editBlog" id="mainForm" onsubmit="return validateForm()"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Edit Your Blog: <?php echo $row['BlogName']?></legend>
            <table>

                <tr>
                    <td colspan="2">
                        <p>
                         
                            <input type="text" name="title" size="90" value = "<?php echo $row['BlogName'] ?>" class="required" hidden>
                        </p>
                        <p>
                            <label>Description:</label>*<br />
                            <textarea name="description" rows="5" cols="61" class="required"><?php echo $row['Description'] ?></textarea>
                        </p>
                <tr>
                    <td>
                        <div class="box">
                            Select thumbnail to upload:*
                            <p></p>
                            <input type="file" name="thumbnail" id="thumbnail">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <label>Continent</label><br />
                            <select name="continent">
                                <option>Choose continent</option>
                                <option <?php echo $op1 ?>>Africa</option>
                                <option <?php echo $op2 ?>>Asia</option>
                                <option <?php echo $op3 ?>>Europe</option>
                                <option <?php echo $op4 ?>>North America</option>
                                <option <?php echo $op5 ?>>South America</option>
                                <option <?php echo $op6 ?>>Australia</option>
                                <option <?php echo $op7 ?>>Antarctica</option>
                            </select>
                        </p>

                        <p>
                            <label>City, Country</label><br />
                            <input type="text" name="cityandcountry" value='<?php echo $row['CityandCountry']; ?>' size="40" />
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p></p>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p>What would you like to do with your blog?*</p>
                        <div class="box">
                            <label>Select all that apply </label><br />
                            <input type="checkbox" name="cc1" <?php echo $cc1 ?>> Post recipes <br />
                            <input type="checkbox" name="cc2" <?php echo $cc2 ?>>Food challenges <br />
                            <input type="checkbox" name="cc3" <?php echo $cc3 ?>>Business/marketing <br />
                            <input type="checkbox" name="cc4" <?php echo $cc4 ?>>Restaurant reviews<br />
                            <input type="checkbox" name="cc5" <?php echo $cc5 ?>>Travel vlogs <br />
                            <input type="checkbox" name="cc6" <?php echo $cc6 ?>>Collaborate with other bloggers <br />
                        </div>
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
                                case "NotSupported":
                                    echo "<script>document.getElementById(\"error-message\").innerHTML = \"The image type you chose is not supported\";</script>";
                                    break;
                                case "Unknown":
                                    echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";
                                    break;
                                default:
                                    echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";



                            }
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="rectangle centered">
                            <input type="submit" value="Submit" name="submit" class="rounded"> <input type="reset" value="Reset"
                                class="rounded">
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</body>

</html>

<?php }else{
echo "<div>You do not have permission to edit this blog. Redirecting...</div>";
echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
}