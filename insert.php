<?php
include "connect_to_db.php";
include "image_verification.php";

//Check if is user
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit();
}
if($_SESSION['user_role'] !== "admin"){
    header("Location: products.php");
    exit();
}

$name = $_POST['name'];
$price = $_POST['price'];
$image = $_FILES['image'];
$errors = array();

//Check if image valide
$image_random_name = image_validation($image, $errors);

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($name) && !empty($price) && $image_random_name !== false) {

    //Clean the inputs
    $valide_name = trim(htmlspecialchars(strip_tags($name)));

    //Insert data on database
    $query = "INSERT INTO `products`(`name`, `price`, `image`) VALUES ('$valide_name', '$price', '$image_random_name')";
    mysqli_query($conn, $query);

        // check if the product upload to server
        if(mysqli_affected_rows($conn) > 0) {
            $_SESSION['status'] = "The product Uploaded Succefully";
        }


} else {
    $_SESSION['alert'] = "The inputs is empty";
    header("location: index.php");
}
//Redirection
header("location: index.php");
?>