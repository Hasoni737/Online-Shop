<?php
include "connect_to_db.php";

session_start();

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];



if($_SERVER['REQUEST_METHOD'] == 'GET') {

    //Insert data on database
    $query = "INSERT INTO `cart_items`(`user_id`, `product_id`) VALUES ('$user_id', '$product_id')";
    mysqli_query($conn, $query);

        // check if the product upload to server
        if(mysqli_affected_rows($conn) > 0) {
            echo "The product Uploaded Succefully";
        }


} else {
    $_SESSION['alert'] = "The inputs is empty";
    // header("location: index.php");
}
//Redirection
header("location: index.php");



?>