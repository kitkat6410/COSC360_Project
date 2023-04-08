function validateForm() {
    var title = document.forms["editPost"]["title"].value;
    var secondTitle = document.forms["editPost"]["secondTitle"].value;
    var content = document.forms["editPost"]["content"].value;
    var image = document.forms['editPost']['image2'].value;
    var agree = document.forms["editPost"]["agree"].checked;
    if (title == "") {
      document.getElementById("error-message").innerHTML = "Please enter post title";
      return false;
    }
    if (secondTitle == "") {
      document.getElementById("error-message").innerHTML = "Please enter secondary title";
      return false;
    }
    if (content == "") {
      document.getElementById("error-message").innerHTML = "Please enter content for your blog post";
      return false;
    }
    if (image == "") {
      document.getElementById("error-message").innerHTML = "Please upload an image";
      return false;
    }
    if (!agree) {
      document.getElementById("error-message").innerHTML = "Please agree to the terms and conditions";
      return false;
    }
    return true;
  }