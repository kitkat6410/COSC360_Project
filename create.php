<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <?php
    require 'SessionValidation.php';
    if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {
        header('Location: Login.php');
    }
    ?>
    <meta charset="utf-8">
    <title>Create your blog</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script type="text/javascript" src="script/create.js"></script>



</head>
<nav>
    <div class="site-title">
        <a href="home.php">
            <h1>Culinary Cloud</h1>
        </a>

            <p>Create New Blog Page</p>
        </div>
        <ul>
            <li><a href="home.php">Back</a></li>

        </ul>
    </nav>


<body>
    <form method="post" action="validateCreate.php" name="createBlog" id="mainForm" onsubmit="return validateForm()"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Create Your Blog</legend>
            <table>

                <tr>
                    <td colspan="2">
                        <p>
                            <label>Title of your blog:</label>*<br>
                            <input type="text" name="title" size="90" class="required" />
                        </p>
                        <p>
                            <label>Description:</label>*<br />
                            <textarea name="description" rows="5" cols="61" class="required"></textarea>
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
                            <label>Continent</label><br>
                            <select name="continent">
                                <option>Choose continent</option>
                                <option>Africa</option>
                                <option>Asia</option>
                                <option>Europe</option>
                                <option>North America</option>
                                <option>South America</option>
                                <option>Australia</option>
                                <option>Antarctica</option>
                            </select>
                        </p>

                        <p>
                            <label>City, Country</label><br>
                            <input type="text" name="cityandcountry" size="40" />
                        </p>
                        <p>
                            <label>Pick your first color</label><br>
                            <input type="color" name="first_color" value="#a3f7bf">
                        </p>
                        <p>
                        <label>Pick your second color</label><br>
                
                            <input type="color" name="second_color" value="#29a19c">
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
                            <input type="checkbox" name="cc1">Post recipes <br />
                            <input type="checkbox" name="cc2">Food challenges <br />
                            <input type="checkbox" name="cc3">Business/marketing <br />
                            <input type="checkbox" name="cc4">Restaurant reviews<br />
                            <input type="checkbox" name="cc5">Travel vlogs <br />
                            <input type="checkbox" name="cc6">Collaborate with other bloggers <br />
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
                            <input type="submit" value="Submit" name="submit" class="rounded"> <input type="reset"
                                value="Reset" class="rounded">
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</body>

</html>