function isPasswordSecure(password) {
   var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])(?!.*\s).{8,}$/;
   return regex.test(password);
}
function validateForm() {
   var name = document.forms["editForm"]["name"].value;
   var email = document.forms["editForm"]["email"].value;
   var image = document.forms["editForm"]["image"].value;
   var birth = document.forms["editForm"]["birth"].value;
   var password = document.forms["editForm"]["password"].value;
   var validatePassword = document.forms["editForm"]["validatePassword"].value;
   
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
      document.getElementById("error-message").innerHTML = "You must be 18 or older to own an account.";
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

}