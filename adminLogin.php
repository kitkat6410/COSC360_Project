<!DOCTYPE html>
<html>

<head lang="en">

   <meta charset="utf-8">
   <title>Admin Login</title>
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/login.css">
   <link rel="stylesheet" href="css/styles.css">
   <script src="script/adminLogin.js"></script>




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
                        case "unAuthorized":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unauthorized access\";</script>";
                           break;
                        case "notLoggedIn":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Please login before accessing this page\";</script>";
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
  
</body>

</html>