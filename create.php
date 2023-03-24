<!DOCTYPE html>
<html>
<head lang="en">
   <?php
   require 'SessionValidation.php' ;
   if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1){
      header('Location: Login.php');
   }
   ?>
   <meta charset="utf-8">
   <title>Create your blog</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <script type="text/javascript" src="script/create.js"></script>

   <nav>
    <div class="site-title">
        <a href="home.php">
            <h1>Culinary Cloud</h1>
            </a>
       
        <p>Create New Blog Page</p>
    </div>
    <ul>
       <li><a href="home.php">Back</a></li></li>
    </ul>
</nav>

</head>
<body>
<form method="post" action="validateCreate.php" name="createBlog" id="mainForm" onsubmit="return validateForm()" enctype="multipart/form-data" >
   <fieldset>
      <legend>Create Your Blog</legend>
      <table>
        
         <tr>
            <td colspan="2">
               <p>
               <label>Title of your blog:</label>*<br/>
               <input type="text" name="title" size="90" class="required"/>
               </p>
               <p>
               <label>Description:</label>*<br/>
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
               <label>Continent</label><br/>
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
               <label>City, Country</label><br/>
               <input type="text" name="cityandcountry" size="40"/>
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
                    <label>Select all that apply </label><br/>
                    <input type="checkbox" name="cc1" >Post recipes <br/>
                    <input type="checkbox" name="cc2" >Food challenges <br/>
                    <input type="checkbox" name="cc3" >Business/marketing <br/>
                    <input type="checkbox" name="cc4" >Restaurant reviews<br/>
                    <input type="checkbox" name="cc5" >Travel vlogs <br/>
                    <input type="checkbox" name="cc6" >Collaborate with other bloggers <br/>
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
            <!-- TO-DO -->
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
      </table>
   </fieldset>
</form>

</body>
</html>
