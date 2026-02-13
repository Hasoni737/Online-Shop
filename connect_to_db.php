<?php
try{
    $conn = mysqli_connect("localhost", "root", "", "online_shop");
} catch(Exception $error) {
    echo $error;
}
?>