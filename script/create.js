
    
    function validateForm() {
       var title = document.forms["createBlog"]["title"].value;
       var desc = document.forms["createBlog"]["description"].value;
       var cc1 = document.forms["createBlog"]["cc1"].checked;
       var cc2 = document.forms["createBlog"]["cc2"].checked;
       var cc3 = document.forms["createBlog"]["cc3"].checked;
       var cc4 = document.forms["createBlog"]["cc4"].checked;
       var cc5 = document.forms["createBlog"]["cc5"].checked;
       var cc6 = document.forms["createBlog"]["cc6"].checked;
       var agree = document.forms["createBlog"]["agree"].checked;

       if (title == "") {
          document.getElementById("error-message").innerHTML = "Please enter a title.";
          return false;
       }

       if (desc == "") {
          document.getElementById("error-message").innerHTML = "Please enter your blog description.";
          return false;
       }

       if (!cc1 && !cc2 && !cc3 && !cc4 && !cc5 && !cc6) {
          document.getElementById("error-message").innerHTML = "Please select a category.";
          return false;
       }

       if (!agree) {
          document.getElementById("error-message").innerHTML = "Please agree to the terms and conditions";
          return false;
       }

    }
