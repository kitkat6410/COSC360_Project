function validateForm() {
  console.log("hi1");
  var title = document.forms["createPost"]["title"].value;
  var secondTitle = document.forms["createPost"]["secondTitle"].value;
  var content = document.forms["createPost"]["content"].value;
  var image = document.forms['createPost']['image2'].value;
  var agree = document.forms["createPost"]["agree"].checked;
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

$(document).ready(function () {
  document.getElementById("show-form").addEventListener("click", function () {
    var form = document.getElementById("my-form");
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  })
  
  $('#my-form').on('submit', function (event) {
    if (!validateForm()) {
      return false;
    }
    event.preventDefault();
    var form_data = new FormData(this);
    $.ajax({
      url: 'validatePost.php',
      method: 'POST',
      data: form_data,
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          $.ajax({
            url: 'reload-blog.php',
            method: 'GET',
            dataType: 'html',
            cache: false,
            success: function (html) {
              $('#my-page').html(html);
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
              console.log(status);
              console.log(error);
            }
          });
        } else {
          document.getElementById("error-message").innerHTML = response.errors;
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
});






