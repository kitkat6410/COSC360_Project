<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Login</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />
   <link rel="stylesheet" href="css/styles.css" />

   <script type="text/javascript" src="script/lab5-1.js"></script>

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

</head>

<body>
   <form method="post" action="profile.php" name="loginForm"
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
                  if (isset($_GET['error']) && $_GET['error'] == 1) {
                     echo "<script>document.getElementById(\"error-message\").innerHTML = \"Username and Password do not match\";</script>";
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
                  <a href="signup.html">Don't have an account? Create one</a>
               </td>
            </tr>
         </table>
      </fieldset>
   </form>

   <script>
      function validateForm() {
         var username = document.forms["loginForm"]["username"].value;
         var password = document.forms["loginForm"]["password"].value;
         if (username == "" && password == "") {
            document.getElementById("error-message").innerHTML = "Username and password must be filled out";
            return false;
         }
         else if (username == "" || password == "") {
        if (username == "") {
            document.getElementById("error-message").innerHTML = "Username must be filled out";
        } else {
            document.getElementById("error-message").innerHTML = "Password must be filled out";
        }
        return false;
    }
  
         
      }
   </script>
</body>

</html>