function validateForm() {
    var title = document.forms["editBlog"]["title"].value;
    var desc = document.forms["editBlog"]["description"].value;
    var thumbnail = document.forms["editBlog"]["thumbnail"].value;
    var cc1 = document.forms["editBlog"]["cc1"].checked;
    var cc2 = document.forms["editBlog"]["cc2"].checked;
    var cc3 = document.forms["editBlog"]["cc3"].checked;
    var cc4 = document.forms["editBlog"]["cc4"].checked;
    var cc5 = document.forms["editBlog"]["cc5"].checked;
    var cc6 = document.forms["editBlog"]["cc6"].checked;
    var agree = document.forms["editBlog"]["agree"].checked;

    if (title == "") {
       document.getElementById("error-message").innerHTML = "Please enter a title.";
       return false;
    }

    if (desc == "") {
       document.getElementById("error-message").innerHTML = "Please enter your blog description.";
       return false;
    }
    if(thumbnail == ""){
      document.getElementById("error-message").innerHTML = "Please enter your desired thumbnail.";
      return false;
    }

    if (!cc1 && !cc2 && !cc3 && !cc4 && !cc5 && !cc6) {
       document.getElementById("error-message").innerHTML = "Please select at least one category.";
       return false;
    }

    if (!agree) {
       document.getElementById("error-message").innerHTML = "Please agree to the terms and conditions";
       return false;
    }

 }
