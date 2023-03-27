<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Edit Account</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <link rel="stylesheet" href="css/login.css" />
   <script type="text/javascript" src="script/edit.js"></script>
 

   <?php
   require 'SessionValidation.php' ?>
</head>

<body>
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
<h1 class="third-color" style="padding: 0.2em; color: white;">Welcome <strong><?php echo $_SESSION['user_id'] ?></strong></h1>
<h2></h2>
   <form method="post" action="validateEdit.php" name="editForm" id="mainForm" onsubmit="return validateForm()"  enctype="multipart/form-data">
      <fieldset>
         <legend>Edit your account on Culinary Cloud</legend>
         <table>
            
            <tr>
               <td colspan="2">
                  <p>
                     <label>Your new name:</label>*<br>
                     <input type="text" name="name" size="90" value="<?php echo $_SESSION['Name'] ?>" pattern="[A-Za-z'-]+ [A-Za-z'-]+"
                        title="Please enter your full name (first and last name separated by a space)">
                  </p>
                  <p>
                     <label for="email">Your new email address:</label>*<br>
                     <input type="email" name="email" value= "<?php echo $_SESSION['Email'] ?>" size="90">
                  </p>
                  <p></p>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="box">
                     New image to display:*
                     <p></p>
                     <input type="file" name="image" id="image">
                  </div>
               </td>
               <td>
                  <div class="box">
                     <p>
                        <label for="birth">Date of Birth:</label>*<br>
                        <input type="date" name="birth" value = <?php echo $_SESSION['BirthDate'] ?>>
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
                     <label for="password">Change password:</label>*<br />
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
                           case "InvalidName":
                              echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Name\";</script>"; 
                              break;
                        case "InvalidPassword":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Password\";</script>";
                           break;
                        case "InvalidBirthdate":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Birthdate\";</script>";
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

</body>

</html>