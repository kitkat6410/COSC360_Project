<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Edit Account</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />
   <link rel="stylesheet" href="css/styles.css" />

   <script type="text/javascript" src="script/lab5-1.js"></script>
   <nav>
      <div class="site-title">
         <a href="home.php">
            <h1>Culinary Cloud</h1>
         </a>

         <p>Edit Account Page</p>
      </div>
      <ul>
         <li><a href="profile.php">Back</a></li>
  
      </ul>
   </nav>

</head>

<body>
<h1 class="third-color">Welcome <strong><?php echo $_SESSION['user_id'] ?></strong></h1>
   <form method="post" action="profile.php" name="editForm" id="mainForm" onsubmit="return validateForm()"  enctype="multipart/form-data">
      <fieldset>
         <legend>Edit your account on Culinary Cloud</legend>
         <table>
            
            <tr>
               <td colspan="2">
                  <p>
                     <label>Your new name:</label>*<br>
                     <input type="text" name="name" size="90" pattern="[A-Za-z'-]+ [A-Za-z'-]+"
                        title="Please enter your full name (first and last name separated by a space)">
                  </p>
                  <p>
                     <label for="email">Your new email address:</label>*<br>
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
                  // if (isset($_GET['error']) && $_GET['error'] == 1) {
                  //    echo "<script>document.getElementById(\"error-message\").innerHTML = \"Username already taken\";</script>";
                  // }
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
                        case "DoesNotExist":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"The File You are trying to use does not exist.\";</script>";
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
   <script>
      function isPasswordSecure(password) {
         var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])(?!.*\s).{8,}$/;
         return regex.test(password);
      }
      function validateForm() {
         var name = document.forms["signupForm"]["name"].value;
         var email = document.forms["signupForm"]["email"].value;
         var image = document.forms["signupForm"]["image"].value;
         var birth = document.forms["signupForm"]["birth"].value;
         var username = document.forms["signupForm"]["username"].value;
         var password = document.forms["signupForm"]["password"].value;
         var validatePassword = document.forms["signupForm"]["validatePassword"].value;
         var agree = document.forms["signupForm"]["agree"].checked;

         if (name == "") {
            document.getElementById("error-message").innerHTML = "Please enter your name.";
            return false;
         }

         if (email == "") {
            document.getElementById("error-message").innerHTML = "Please enter your email address.";
            return false;
         }
       if (image == "") {
             document.getElementById("error-message").innerHTML = "Profile image is required.";
            return false;
       }
         if (birth == "") {
            document.getElementById("error-message").innerHTML = "Please enter your date of birth.";
            return false;
         }
         // Check if the user is 18 or older
         var eighteenYearsAgo = new Date();
         eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);
         var userBirthDate = new Date(birth);
         if (userBirthDate > eighteenYearsAgo) {
            document.getElementById("error-message").innerHTML = "You must be 18 or older to sign up.";
            return false;
         }

         if (username == "") {
            document.getElementById("error-message").innerHTML = "Please enter your preferred username.";
            return false;
         }

         if (password == "") {
            document.getElementById("error-message").innerHTML = "Please enter your password";
            return false;
         }
         if (!isPasswordSecure(password)) {
            document.getElementById("error-message").innerHTML = "Please choose a password that is at least 8 characters long, contains at least one uppercase letter, at least one lowercase letter, at least one number, and at least one special character ";
            return false;
         }

         if (validatePassword == "") {
            document.getElementById("error-message").innerHTML = "Please confirm your password";
            return false;
         }

         if (password != validatePassword) {
            document.getElementById("error-message").innerHTML = "Passwords do not match.";
            return false;
         }

         if (!agree) {
            document.getElementById("error-message").innerHTML = "Please agree to the terms and conditions";
            return false;
         }


      }
   </script>
</body>

</html>