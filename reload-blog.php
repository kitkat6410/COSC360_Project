<?php
include ('../connectiondb.php');
require 'SessionValidation.php';
if (isset($_GET['bid'])) {
    $_SESSION['BID'] = $_GET['bid'];
}
if (!isset($_SESSION['BID'])) {
    print_r($_SESSION);
    echo "Session error: Blog ID not found";
    exit();
}
$bid = $_SESSION['BID'];
// $newPost = false;
// $newComment = false;
// // Retrieve timestamp parameter from AJAX call
// $lastTimestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : 0;
// $check = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid AND DatePosted > :timestamp");
// $check->bindParam(':bid', $_SESSION['BID']);
// $check->bindParam(':timestamp', $lastTimestamp);
// $check->execute();


// if($check->rowCount() != 0){
//     $newPost = true;

$stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = $bid");
$stmt->execute();
$row = $stmt->fetch();

$stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
$stmt2->bindParam(':bid', $_SESSION['BID']);
$stmt2->execute();



?>
    <?php

while ($row2 = $stmt2->fetch()) {
    $date = date('Y-m-d\TH:i:sP', strtotime($row2['DatePosted']));
    ?>
<section id="myBlogContainer">

    <article>
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
echo '<div class="comment-container third-color">';
echo '<div class="comments fourth-color">';
echo '<div class="meta">';
echo '<span class="username">' . $comment['Username'] . '</span>';
echo '<span class="date"><time datetime="' . $comment['Date'] . '">' . $comment['Date'] . '</time></span>';
echo '</div>';
echo '<h3 class="title">' . $comment['Title'] . '</h3>';
echo '<p class="content">' . $comment['Content'] . '</p>';

// Output replies
if (isset($_SESSION["LoggedIn"]) && $_SESSION['LoggedIn'] == true && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) {
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
        console.log(<?php print_r($comment)?>);
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

          document.getElementById("error-comment-reply-<?php echo $reply['ParentID'] ?>").innerHTML = response.errors;

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
<p id="<?php echo $row2['PID'] ?>"></p>
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


<?php

while ($row2 = $stmt2->fetch()) {
    $date = date('Y-m-d\TH:i:sP', strtotime($row2['DatePosted']));
    ?>
<section id="myBlogContainer">

    <article>
        <time datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row2['DatePosted'])) ?></time>
        <p>By: <?php echo $row2['Author'] ?></p>
        <h1><?php echo $row2['BlogTitle'] ?></h1>

        <h2><?php echo $row2['BlogSecondaryTitle'] ?></h2>
        <h2><?php echo $row2['PID'] ?></h2>



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
echo '<div class="comment-container third-color">';
echo '<div class="comments fourth-color">';
echo '<div class="meta">';
echo '<span class="username">' . $comment['Username'] . '</span>';
echo '<span class="date"><time datetime="' . $comment['Date'] . '">' . $comment['Date'] . '</time></span>';
echo '</div>';
echo '<h3 class="title">' . $comment['Title'] . '</h3>';
echo '<p class="content">' . $comment['Content'] . '</p>';

// Output replies
if (isset($_SESSION["LoggedIn"]) && $_SESSION['LoggedIn'] == true && isset($_SESSION['Status']) && $_SESSION['Status'] == 1) {
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
<p id="<?php echo $row2['PID'] ?>"></p>
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



</script>



<?php } ?>



</script>



<?php } ?>