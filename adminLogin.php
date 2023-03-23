<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Admin Login</title>
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/login.css">
   <link rel="stylesheet" href="css/styles.css">

   <script type="text/javascript" src="script/lab5-1.js"></script>

   <nav>
      <div class="site-title">
         <a href="home.php">
            <h1>Culinary Cloud</h1>
         </a>

         <p>Admin Login Page</p>
      </div>
      <ul>
         <li><a href="home.php">Back</a></li>
         </li>
      </ul>
   </nav>

</head>

<body>
   <form method="post" action="adminProfile.php" name="adminForm"
      onsubmit="return validateForm()">
      <fieldset>
         <legend>Administrator Login</legend>
         <table>
            <tr>
               <td colspan="2">
                  <p>
                     <label for="username">Username:</label><br>
                     <input type="text" name="username" size="90">
                  </p>

                  <p>
                     <label for="password">Password:</label><br>
                     <input type="password" name="password" size="50">
                  </p>

                  <p>
                     <label for="refnumber">Admin reference number:</label><br>
                     <input type="number" name="refnumber" size="50">
                  </p>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <hr>
                  <p id="error-message"></p>
                  <?php
                  if (isset($_GET['error'])) {
                     switch ($_GET['error']) {
                        case "InvalidLogin":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Username, Password and/or Reference Number do not match.\";</script>";
                           break;
                        case 1:
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error\";</script>";
                        default:
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error\";</script>";


                     }

                  }
                  ?>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <div class="rectangle centered">
                     <input type="submit" value="Submit" class="rounded"><input type="reset" value="Reset"
                        class="rounded">
                  </div>
               </td>
            </tr>
            <tr>
               <td colspan="2" class="centered">
                  <a href="#">Forgot Password?</a>
               </td>
            </tr>
         </table>
      </fieldset>
   </form>
   <script>

      function validateForm() {
         var username = document.forms["adminForm"]["username"].value;
         var password = document.forms["adminForm"]["password"].value;
         var refnumber = document.forms["adminForm"]["refnumber"].value;
         if (username == "") {
            document.getElementById("error-message").innerHTML = "Please enter username";
            return false;
         }
         if(password ==""){
            document.getElementById("error-message").innerHTML = "Please enter password";
            return false;
         }
         if(refnumber =="" || refnumber.length != 8){
            document.getElementById("error-message").innerHTML = "Please enter a valid 8-digit reference number";
            return false;
         }

      }
   </script>
</body>

</html>