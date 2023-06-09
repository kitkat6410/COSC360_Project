<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Login</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <script src="script/login.js"></script>

   

</head>

<body>
<nav>
      <div class="site-title">
         <a href="home.php">
            <h1>Culinary Cloud</h1>
         </a>

         <p>Login Page</p>
      </div>
      <ul>
         <li><a href="home.php">Back</a></li>
         </li>
      </ul>
   </nav>
   <form method="post" action="query/profile.php" name="loginForm"
      onsubmit="return validateForm()">
      <fieldset>
         <legend>Login to your account on Culinary Cloud</legend>
         <table>
            <tr>
               <td colspan="2">
                  <p>
                     <label for="username">Username:</label>
                     <br>
                     <input type="text" name="username" size="70" class="required" />

                  </p>

                  <p>
                     <label for="password">Password:</label><br>
                     <input type="password" name="password" size="50" class="required" />
                  </p>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  
                  <hr>
                  <p id="error-message"></p>
                  <?php
                  if (isset($_GET['error'])) {
                     switch($_GET['error']){
                        case "InvalidLogin":
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Username and Password do not match\";</script>";
                           break;
                        case 1:
                           echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error\";</script>";
                           

                     }
                     
                  }
                  ?>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <div class="rectangle centered">
                     <input type="submit" value="Submit" class="rounded"> <input type="reset" value="Reset"
                        class="rounded">
                  </div>
               </td>
            </tr>
            <tr>
               <td colspan="2" class="centered">
                  <a href="#">Forgot Password?</a>
               </td>
            </tr>
            <tr>
               <td colspan="2" class="centered">
                  <a href="signup.php">Don't have an account? Create one</a>
               </td>
            </tr>
         </table>
      </fieldset>
   </form>


</body>

</html>