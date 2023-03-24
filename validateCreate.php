<?php
require 'connectiondb.php';
require 'SessionValidation.php';
print_r($_SESSION);
try {
    $bTitle_input = $_POST['title'];
    $desc = $_POST['description'];
    $target_dir = "images/";
    $target_file = $target_dir . uniqid() . '.' . str_replace(' ', '_', basename($_FILES["thumbnail"]["name"]));
    $continent = isset($_POST['continent']) && $_POST['continent'] != 'Choose continent' ? $_POST['continent'] : NULL;
    $cityCountry = $_POST['cityandcountry'];
    $recipe = isset($_POST['cc1']) ? 1 : 0;
    $challenge = isset($_POST['cc2']) ? 1 : 0;
    $business = isset($_POST['cc3']) ? 1 : 0;
    $review = isset($_POST['cc4']) ? 1 : 0;
    $travel = isset($_POST['cc5']) ? 1 : 0;
    $collaborate = isset($_POST['cc6']) ? 1 : 0;

    echo "$bTitle_input $desc $target_file $continent $cityCountry $recipe $challenge $business $review $travel $collaborate";
    $input = "INSERT INTO bloginfo VALUES (BlogName, Description, Continent, CityandCountry, cc1, cc2, cc3, cc4, cc5, cc6, Thumbnail";
} catch (Exception $e) {
    error_log($e->getMessage());
    echo $e;
}
?>