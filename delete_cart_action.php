<?php
include "connect_to_db.php";

session_start();

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    // Delete product from database
    $query = "DELETE FROM cart_items WHERE `cart_items`.`id` = '$id'";
    

    $result = mysqli_query($conn, $query);

    // if(!$result){
    //     echo "SQL Error: " . mysqli_error($conn);
    // } else {
    //     echo "Rows deleted: " . mysqli_affected_rows($conn);
    // }

    //Redirection
    header("location: cart.php");
}
?>