<?php
require 'connectiondb.php';
require 'SessionValidation.php';
$_SESSION['BID'] = 7;
$bid = $pdo->quote($_SESSION['BID']);
$stmt = $pdo->prepare("SELECT * FROM bloginfo WHERE BID = $bid");
$stmt->execute();
$row = $stmt->fetch();

$stmt2 = $pdo->prepare("SELECT * FROM blogpost WHERE BID = :bid ORDER BY DatePosted DESC");
$stmt2->bindParam(':bid', $_SESSION['BID']);
$stmt2->execute();



?>

<?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo $row2['Author'], $row2['BlogTitle'], $row2['PID'], $row2['BID'], $row2['BlogSecondaryTitle'], $row2['DatePosted'], $row2['Image'], $row2['Content'];
            $date = date('Y-m-d\TH:i:sP', strtotime($row2['DatePosted']));
            echo $date;

            ?>


        <section id="myBlogContainer">

            <article>
                <time datetime="<?= $date ?>"><?= date('F j, Y \a\t g:i A T', strtotime($row2['DatePosted'])) ?></time>
                <p>By: <?php echo $row2['Author'] ?></p>
                <h1><?php echo $row2['BlogTitle'] ?></h1>

                <h2><?php echo $row2['BlogSecondaryTitle'] ?></h2>

                <!-- <img class="baking-image" src=""> -->
                <p><?php echo $row2['Image'] ?></p>
                <img class="baking-image" src="<?php echo $row2['Image'] ?>">

                <p><?php echo $row2['Content'] ?></p>

            </article>
        </section>
        <?php } ?>