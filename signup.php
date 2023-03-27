<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Sign Up</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <script src="script/signup.js"></script>
  

</head>

<body>
<nav>
      <div class="site-title">
         <a href="home.php">
            <h1>Culinary Cloud</h1>
         </a>

         <p>Sign Up Page</p>
      </div>
      <ul>
         <li><a href="login.php">Back</a></li>
  
      </ul>
   </nav>
   <form method="post" action="validateSignup.php" name="signupForm" id="mainForm" onsubmit="return validateForm()"  enctype="multipart/form-data">
      <fieldset>
         <legend>Create an account on Culinary Cloud</legend>
         <table>
            <tr>
               <td colspan="2">
                  <p>
                     <label>Your name:</label>*<br>
                     <input type="text" name="name" size="90" pattern="[A-Za-z'-]+ [A-Za-z'-]+"
                        title="Please enter your full name (first and last name separated by a space)">
                  </p>
                  <p>
                     <label for="email">Your email address:</label>*<br>
                     <input type="email" name="email" size="90">
                  </p>
                  <p></p>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="box">
                     Select image to upload:*
                     <p></p>
                     <input type="file" name="image" id="image">
                  </div>
               </td>
               <td>
                  <div class="box">
                     <p>
                        <label for="birth">Date of Birth:</label>*<br>
                        <input type="date" name="birth">
                     </p>
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
               <td colspan="2">
                  <p>
                     <label for="username">Your preferred username:</label>*<br>
                     <input type="text" name="username" size="90">
                  </p>
                  <p>
                     <label for="password">Your password:</label>*<br />
                     <input type="password" name="password" size="50">
                  </p>
                  <p>
                     <label for="validatePassword">Confirm password:</label>*<br />
                     <input type="password" name="validatePassword" size="50">
                  </p>
               </td>
            </tr>

            <tr>
               <td colspan="2">
                  <div class="rectangle" id="agree">
                     <label>
                        <input type="checkbox" name="agree" value="yes">
                        I agree to the terms and conditions*
                     </label>

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
                        case "InvalidEmail":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Email\";</script>";
                           break;
                        case "InvalidUsername":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Username\";</script>";
                           break;
                        case "InvalidPassword":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Password\";</script>";
                           break;
                        case "InvalidBirthdate":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Birthdate\";</script>";
                           break;
                        case "DuplicateUsername":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Username already taken. Please choose another\";</script>";
                           break;
                        case "NoImage":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Please select an image.\";</script>";
                           break;
                        case "NotAnImage":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"The file you chose is not an image. Please choose an image\";</script>";
                           break;
                        case "NotSupported":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"The image type you chose is not supported\";</script>";
                           break;
                        case "UploadError":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"There was an issue with uploading your chosen image. Please try again.\";</script>";
                           break;
                        case "Large":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Your image file is too large.\";</script>";
                           break;
                        case "Unknown":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";
                           break;
                        default:
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";


                     }
                  }
                  ?>
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