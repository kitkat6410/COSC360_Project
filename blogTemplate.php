<?php

include('../connectiondb.php');
require 'SessionValidation.php';
if (isset($_GET['bid'])) {
    $_SESSION['BID'] = $_GET['bid'];
}
if (!isset($_SESSION['BID'])) {
    echo "<script>setTimeout(function(){ window.location.href = 'blogs.php'; }, 2000);</script>";
    echo "Session error: Blog ID not found. Redirecting...";
    exit();
}

try {

    $bid = $_SESSION['BID'];
    $stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = :bid");
    $stmt->bindParam(':bid', $bid);
    $stmt->execute();
    $row = $stmt->fetch();

    if (!$row) {
        echo "Database error: Blog not found";
        exit();
    }

    $stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
    $stmt2->bindParam(':bid', $_SESSION['BID']);
    $stmt2->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">


    <title>
        CulinaryCloud | MyBlog
    </title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/myblog.css">
    <link rel="stylesheet" href="css/comment.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script/jquery-3.6.4.min.js"></script>
    <script src="script/blogTemplate.js"></script>
    <style>
    body {
        margin-top: 0;
        background-image: url('<?php echo $row['Thumbnail'] ?>');
        background-size: 25em;


    }
    article {
    clear: left;
    background: <?php echo $row['secondColor']?>;
    color: rgb(30, 30, 30);

    padding: 1em;

    margin-top: 1em;
}
#blogPage {
    background:<?php echo $row['firstColor'] ?>;
}
legend {
      background-color: <?php echo $row['secondColor'] ?> ;
      margin: 0 auto;
      width: 90%;
      padding: 0.25em;
      text-align: center;
      font-weight: bold;
      font-size: 100%;
   }
   fieldset {
      margin: 1em auto;
      background-color: <?php echo $row['firstColor'] ?>;
      width: 60%;
   }
   .box {
      border: 1pt solid <?php echo $row['secondColor'] ?>;
      padding: 0.5em;
      margin-bottom: 0.5em;
   }
   .rectangle {
      background-color: <?php echo $row['secondColor'] ?> ;
      padding: 0.5em;
   }
   hr{
    border: 1px solid <?php echo $row['secondColor'] ?>  ;
   }

   .firstColor{
    background:<?php echo $row['firstColor'] ?>;
   }
   .secondColor{
    background: <?php echo $row['secondColor'] ?>
   }

    </style>



    </link>




</head>


<body>
<nav>
    <div class="site-title">
        <a href="home.php">
            <h1>Culinary Cloud</h1>
        </a>
    </div>
    <ul>
    <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { 
    if (isset($_SESSION['isLoggedAdmin'])) { ?>
        <li><a href="adminProfile.php">Account</a></li>
    <?php } else { ?>   
        <li><a href="query/profile.php">Account</a></li>
    <?php }
} ?>
        <li><a href="blogs.php">Back to Browse Blogs</a></li>
    </ul>
</nav>
<section id="my-page">
    <header id="blogPage">
   
    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $row['Username'] || (isset($_SESSION['isLoggedAdmin']) && $_SESSION['isLoggedAdmin'] == 1)) && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) {  ?>
    <button class = "rounded" onclick="location.href='editBlog.php'">Edit</button>
    <button class="rounded red" onclick="deleteBlogClicked('<?php echo $_SESSION['BID']; ?>')">Delete</button>
    <br>
    <?php } ?>
        <h1 id=sugar><?php echo ($row['BlogName']) ?></h1>
        <div id="desc">
            <p><?php echo ($row['Description']) ?></p>
            </p>
            <?php $date = date('Y-m-d\TH:i:sP', strtotime($row['BlogCreated'])); ?>
            <p>Blog owner: <?php echo $row["Username"] ?> <br>
                Blog created: <time
                    datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row['BlogCreated'])) ?></time>
            </p>
        </div>
    </header>

    <?php

while ($row2 = $stmt2->fetch()) {
    $date = date('Y-m-d\TH:i:sP', strtotime($row2['DatePosted']));
    ?>
<section id="myBlogContainer">

    <article>
    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $row['Username'] || (isset($_SESSION['isLoggedAdmin']) && $_SESSION['isLoggedAdmin'] == 1)) && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
        <button class="rounded" onclick="location.href='editPost.php?pid=<?php echo $row2['PID']; ?>'">Edit</button>
    <button class="rounded red" onclick="if (confirm('Are you sure you want to delete?')) { deletePostClicked('<?php echo $row2['PID']; ?>', event); } return false;">Delete</button>
    <br>
    <?php } ?>
        <time datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row2['DatePosted'])) ?></time>
        <p>By: <?php echo $row2['Author'] ?></p>
        <h1><?php echo $row2['BlogTitle'] ?></h1>

        <h2><?php echo $row2['BlogSecondaryTitle'] ?></h2>
       



        <img class="baking-image" src="<?php echo $row2['Image'] ?>">

        <p><?php echo nl2br($row2['Content']) ?></p>

    </article>
    <br>
    <?php
// Retrieve all comments and their replies
$stmtComment = $pdo->prepare("
SELECT c1.*, c2.Username AS ParentUsername
FROM comments c1
LEFT JOIN comments c2 ON c1.ParentCommentID = c2.CID
WHERE c1.BID = :bid AND c1.PID = :pid
ORDER BY c1.CommentPosted DESC");
$stmtComment->bindParam(':bid', $_SESSION['BID']);
$stmtComment->bindParam(':pid', $row2['PID']);
$stmtComment->execute();

// Store comments in an array to facilitate outputting replies
$comments = array();
while ($rowComment = $stmtComment->fetch()) {
$comment = array(
'ID' => $rowComment['CID'],
'Username' => $rowComment['Username'],
'Date' => date('F j, Y \a\t g:i A T', strtotime($rowComment['CommentPosted'])),
'Title' => $rowComment['Title'],
'Content' => $rowComment['Content'],
'ParentID' => $rowComment['ParentCommentID'],
'ParentUsername' => $rowComment['ParentUsername']
);
$comments[$rowComment['CID']] = $comment;
}

?>
 <?php

// Output comments and replies
foreach ($comments as $comment) {
if ($comment['ParentID'] === null) { // Comment is not a reply
echo '<div class="comment-container secondColor">';
echo '<div class="comments firstColor">';
echo '<div class="meta">';
echo '<span class="username">' . $comment['Username'] . '</span>';
echo '<span class="date"><time datetime="' . $comment['Date'] . '">' . $comment['Date'] . '</time></span>';
echo '</div>';
echo '<h3 class="title">' . $comment['Title'] . '</h3>';
echo '<p class="content">' . $comment['Content'] . '</p>';

// Output replies
//hi
foreach ($comments as $reply) {
?>    
    
    <?php
    if ($reply['ParentID'] === $comment['ID']) {
        echo '<div class="reply-container">';
        echo '<div class="reply meta">';
        echo '<span class="username">' . $reply['Username'] . '</span>';
        echo '<span class="date"><time datetime="' . $reply['Date'] . '">' . $reply['Date'] . '</time></span>';
        echo '<p class="reply-content">' . $reply['Content'] . '</p>';
        echo '</div>';
        
        echo '</div>';
        }
        }  // Add form for replying to the comment
        if (isset($_SESSION["LoggedIn"]) && $_SESSION['LoggedIn'] == true && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) {
        echo '<div class="reply-form">';
        echo '<form id="reply-form-' . $comment["ID"] . '" name="createReply" action="validateReply.php" method="POST">';
        // echo '<input type="hidden" name="bid" value="' . $_SESSION['BID'] . '">';
        echo '<input type="hidden" name="pid" value="' . $row2['PID'] . '">';
        echo '<input type="hidden" name="parent_id" value="' . $comment['ID'] . '">';
        // echo '<input type="hidden" name="username" value="' . $_SESSION['user_id']. '">';
        echo '<textarea name="content" class="my-input" placeholder="Add a reply" required></textarea>';
        echo '<p id="error-comment-reply-' . $comment["ID"]. '"></p>';
        echo '<button type="submit"class="rounded">Reply</button>';
        echo '</form>';
        echo '</div>';
      ?>  <script>
 
        $("#reply-form-<?php echo $comment['ID'] ?>").on('submit', function(event) {

event.preventDefault();

var reply_data = new FormData(this);
$.ajax({
  url: 'validateReply.php',
  method: 'POST',
  data: reply_data,
  dataType: 'json',
  cache: false,
  contentType: false,
  processData: false,
  success: function(response) {
    if (response.success) {
        $.ajax({
            url: 'reload-blog.php',
            method: 'GET',
            dataType: 'html',
            cache: false,
            success: function(html) {
                $('#my-page').html(html);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    } else {
        document.getElementById("error-reply-<?php echo $row2['PID'] ?>")
            .innerHTML = response.errors;
    }

  },
  error: function(xhr, status, error) {
      console.log(xhr.responseText);
  }


}

);

});

      </script> <?php

     }
         
    echo '</div>'; // .comments
    echo '</div>'; // .comment-container
    }
} ?>
</section>


<?php if (isset($_SESSION["LoggedIn"]) && $_SESSION['LoggedIn'] == true && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>

<form id="comment-form-<?php echo $row2['PID'] ?>" method="post" action="validateComment.php"
    name="createComment" onsubmit="return validateComment()">

    <fieldset>
        <legend>Leave a comment</legend>
        <table>
            <tr>
                <td colspan="2">

                    <p>
                        <label for="title">Title:</label>
                        <br>
                        <input type="text" id="title" class="my-input" name="title" size="15">
                    </p>
                    <p>
                        <label for="comment">Comment:</label>
                        <br>
                        <input type="text" id="comment" class="my-input" name="comment" size="30">
                    </p>
                </td>
            </tr>
            <!-- code for accessing PID of comment section -->
            <div style="display:none;">
                <label for="pid"></label>
                <br>
                <input type="text" id="pid" name="pid" value="<?php echo $row2['PID'] ?>">
            </div>
            <tr>
                <td colspan="2">
                    <hr>
                    <p id="error-comment-<?php echo $row2['PID'] ?>"></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="rectangle centered">
                        <input type="submit" value="Submit" class="rounded">
                        <input type="reset" value="Reset" class="rounded">
                    </div>
                </td>
            </tr>

        </table>
    </fieldset>
</form>
<?php } ?>

<script>


$("#comment-form-<?php echo $row2['PID'] ?>").on('submit', function(event) {

    event.preventDefault();

    var comment_data = new FormData(this);
    $.ajax({
            url: 'validateComment.php',
            method: 'POST',
            data: comment_data,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    $.ajax({
                        url: 'reload-blog.php',
                        method: 'GET',
                        dataType: 'html',
                        cache: false,
                        success: function(html) {
                            $('#my-page').html(html);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            console.log(status);
                            console.log(error);
                        }
                    });

                } else {

                    document.getElementById("error-comment-<?php echo $row2['PID'] ?>")
                        .innerHTML = response.errors;

                }

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }


        }

    );

});
    function deletePostClicked(pid, event) {
        event.preventDefault();

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "deletePost.php?pid=" + pid, true);
            xmlhttp.send();
        
    }

    // Attach the event listener to all delete buttons
    var deleteButtons = document.querySelectorAll('[id^="deleteButton_"]');
    deleteButtons.forEach(function(button) {
        var pid = button.id.split("_")[1];
        button.addEventListener("click", function(event) {
            deletePostClicked(pid, event);
        });
    });



</script>



<?php } ?>
    </section>

    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $row['Username'] && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) { ?>
    <button class="rounded" id="show-form">New Post</button>
    <?php } ?>
    <form id="my-form" style="display: none;" method="post" action="validatePost.php" name="createPost"
        onsubmit="return validateForm()" enctype="multipart/form-data">
        <fieldset>
            <legend>Make New Blog Post</legend>
            <table>

                <tr>
                    <td>
                        <p>
                            <label>Title of your blog post:</label>*<br />
                            <input type="text" name="title" size="90" class="required" />
                        </p>
                        <p>
                            <label>Secondary Title of your blog post:</label>*<br />
                            <input type="text" name="secondTitle" size="90" class="required" />
                        </p>
                        <p>
                            <label>Content:</label>*<br />
                            <textarea name="content" rows="5" cols="61" class="required"></textarea>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="box">
                            Select image to upload:*
                            <p></p>
                            <input type="file" name="image2" id="image2">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p></p>
                        <hr>
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
                    </td>
                    <?php
                    if (isset($_GET['error'])) {
                        switch ($_GET['error']) {
                            case "BlogExists":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"You already have a blog with that name. Please choose another.\";</script>";
                                break;
                            case "NotAnImage":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"The file you chose is not an image. Please choose an image\";</script>";
                                break;
                            case "NoImage":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Please select an image.\";</script>";
                                break;
                            case "InvalidUsername":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Invalid Username\";</script>";
                                break;
                            case "Large":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Your image file is too large.\";</script>";
                                break;
                            case "UploadError":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"There was an issue with uploading your chosen image. Please try again.\";</script>";
                                break;
                            case "EmptyFields":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Fields were left empty.\";</script>";
                                break;
                            case "DuplicatePost":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"You already have a title with the same name. Please choose another.\";</script>";
                                break;
                            case "Unknown":
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";
                                break;
                            default:
                                echo "<script>document.getElementById(\"error-message\").innerHTML = \"Unknown error occured.\";</script>";



                        }
                    } ?>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="rectangle centered">
                            <input type="submit" value="Submit" id="Submit" class="rounded"> <input type="reset"
                                value="Reset" class="rounded">
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>