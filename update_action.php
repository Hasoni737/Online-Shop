<?php 

include "connect_to_db.php";
include "image_verification.php";

session_start();

//Check if is user
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit();
}
if($_SESSION['user_role'] !== "admin"){
    header("Location: products.php");
    exit();
}

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_FILES['image'];
$errors = array();

//Check if image valide
if(!empty($_FILES['image']['name'])) {
    $image_random_name = image_validation($image, $errors);
    if($image_random_name !== false) {
        //Clean the inputs
        $valide_name = trim(htmlspecialchars(strip_tags($name)));
    
        //Insert data on database
        $query = "UPDATE `products` SET `name` = '$valide_name', `price` = '$price', `image` = '$image_random_name' WHERE id = $id";
        $result = mysqli_query($conn, $query);
    
        // check if the product upload to server
        if($result) {
            header("location: products.php");
            // Delete image from folder
            $path = getcwd() .'\images\\'. $_POST['old_image'];
            if (file_exists($path)) {
                unlink($path);
            }
        } else {
            header("location: update.php?id=$id");
            $_SESSION['update'] = "The product Not Updated";
        }
    } else {
            // $_SESSION['alert'] = "Image is not valide";
            header("location: update.php?id=$id");
    }


} else {
    //Clean the inputs
    $valide_name = trim(htmlspecialchars(strip_tags($name)));

    $old_image = $_POST['old_image'];

    //Insert data on database
    $query = "UPDATE `products` SET `name` = '$valide_name', `price` = '$price', `image` = '$old_image' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // check if the product upload to server
    if($result) {
        header("location: products.php");
    } else {
        header("location: update.php?id=$id");
        $_SESSION['alert'] = "The product Not Updated";
    }
}

?>