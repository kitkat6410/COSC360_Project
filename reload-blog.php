<?php
require 'connectiondb.php';
require 'SessionValidation.php';
$bid = $_SESSION['BID'];
$stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = $bid");
$stmt->execute();
$row = $stmt->fetch();

$stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
$stmt2->bindParam(':bid', $_SESSION['BID']);
$stmt2->execute();



?>

<?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
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
<!-- comment section -->


<!-- <section id="comment-section"> -->
<!-- <button class="show-comments-btn rounded">Show Comments</button> -->
<br>
    <?php $stmtComment = $pdo->prepare("SELECT * FROM comments WHERE BID = :bid AND PID = :pid ORDER BY CommentPosted DESC");
            $stmtComment->bindParam(':bid', $_SESSION['BID']);
            $stmtComment->bindParam(':pid', $row2['PID']);
            $stmtComment->execute();
            while ($rowComment = $stmtComment->fetch()) {

                ?>
       
    <div class="comment-container third-color">
      
        <div class="comments fourth-color">
            <!-- <div class="comment fourth-color"> -->
            <div class="meta">
                <?php $dateComment = date('Y-m-d\TH:i:sP', strtotime($rowComment['CommentPosted'])); ?>
                <span class="username"><?php echo $rowComment['Username'] ?></span>
                <span class="date"> <time datetime="<?= $dateComment ?>"><?= date('F j, Y \a\t g:i A T', strtotime($rowComment['CommentPosted'])) ?></time></span>
            </div>
            <h3 class="title"><?php echo $rowComment['Title'] ?></h3>
            <p class="content"><?php echo $rowComment['Content'] ?></p>
        </div>
    </div>
    <?php
            }
            ?>
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
                            <input type="text" id="title" name="title" size="15">
                        </p>
                        <p>
                            <label for="comment">Comment:</label>
                            <br>
                            <input type="text" id="comment" name="comment" size="30">
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
<!-- </section> -->
<script>
$("#comment-form-<?php echo $row2['PID'] ?>").on('submit', function(event) {
    
    // if (!validateComment()) {
    //   return false;
    //  }
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
               
                    document.getElementById("error-comment-<?php echo $row2['PID'] ?>").innerHTML = response.errors;
            
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

</section>
<?php } ?>