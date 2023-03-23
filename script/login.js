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
