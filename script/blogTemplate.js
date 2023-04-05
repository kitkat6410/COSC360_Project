function validateForm() {
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

function validateComment() {
  var title = document.forms["createComment"]["title"].value;
  var comment = document.forms["createComment"]["comment"].value;
  if (title == "") {
    document.getElementById("error-comment").innerHTML = "Please enter comment title";
    return false;
  }
  if (comment == "") {
    document.getElementById("error-comment").innerHTML = "Please enter your comment";
    return false;
  }
  return true;
}
// setInterval(function() {
//   console.log('Calling $.ajax');
//   $.ajax({
//     url: 'reload-blog.php',
//     method: 'GET',
//     dataType: 'html',
//     cache: false,
//     success: function (html) {
//       $('#my-page').html(html);
//     },
//     error: function (xhr, status, error) {
//       console.log(xhr.responseText);
//       console.log(status);
//       console.log(error);
//     }
//   });
//   console.log('$.ajax called');
// }, 5000);
$(document).ready(function () {
  var recentTyped = Date.now();
  var focus = false;

  setInterval(function() {

    $('.my-input').on('keydown', function() {
        recentTyped = Date.now();
  
    });
    $('.my-input').on('blur', function() {
        focus = false;
        console.log(focus);
    });
    $('.my-input').on('focus', function() {
        focus = true;
        console.log(focus);
    });
  

   
      if (focus == false || Date.now() - recentTyped > 60000) {
          $.ajax({
              url: 'reload-blog.php',
              type: 'POST',
              data: {},
              success: function(response) {
                  if (response) {
                      recentTyped = Date.now();
                      focus = false;
                      var newContent = $('<div>').html(response);
                      var formsToPreserve = $('#my-page form');
                      formsToPreserve.each(function() {
                          var formToPreserve = $(this);
                          newContent.find('#' + formToPreserve.attr('id'))
                              .replaceWith(formToPreserve);
                      });
                      $('#my-page').empty().append(newContent.contents());
                      formsToPreserve.each(function() {
                          var formToPreserve = $(this);
                          formToPreserve.insertAfter('#' + formToPreserve
                              .attr('data-id'));
                      });

                  }
              }
          });
      }
  }, 2000);

});


$(document).ready(function () {
 
console.log("hello");
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
  })
  




});






