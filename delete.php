<?php
include "connect_to_db.php";

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

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image'];

    // Delete product from database
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    // Delete image from folder
    $path = getcwd() .'/images//'. $image_name;
    if (file_exists($path)) {
        unlink($path);

    }


    header("location: products.php");
}
?>