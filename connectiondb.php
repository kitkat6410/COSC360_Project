<?php
try{

    $connString = "mysql:host=127.0.0.1;dbname=culinarycloud";
    $user = "root";
    $pass = "";

    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = "select * from admininfo";
    // $result = $pdo->query($sql);

    // while($row = $result->fetch()){
    //     echo $row['refnum'];
    //     echo "<br/>";
    // }
    echo "Successfully connected";
    // $pdo = null;
}
catch (PDOException $e){
    die($e ->getMessage());
}

?>