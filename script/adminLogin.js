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

};
