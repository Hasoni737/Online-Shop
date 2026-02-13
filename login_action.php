<?php
include "connect_to_db.php";

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//Cleaning the inputs
$valide_username = trim(htmlspecialchars(strip_tags($username)));
$valide_password = trim((strip_tags($password)));

//Check if username or password is not empty
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($valide_username) && !empty($valide_password)) {
    
    //Get users from DB
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $query);

    //Check if username et password is in DB
    while($row = mysqli_fetch_assoc($result)) {
        
        if($valide_username == $row['username'] && $valide_password == $row['password']){
            echo "Login Succefully";

            //Delete the session if the account correct
            if(isset($_SESSION['login'])){
                unset($_SESSION['login']);
            }

            //Set sessions
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['user_role'] = $row['role'];
            //Redirection
            header("location: products.php");
            break;
        } else {
            $_SESSION['login'] = "username or password is Incerrect";
            echo "username or password is Incerrect";
            header("location: login.php");
        }

    }

} else {
    echo "Username Or Password Is Empty";
}
?>