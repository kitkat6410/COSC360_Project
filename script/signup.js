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
