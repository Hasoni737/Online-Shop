<?php
include "connect_to_db.php";

session_start();

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

//Cleaning the inputs
$valide_name = trim(htmlspecialchars(strip_tags($name)));
$valide_username = trim(htmlspecialchars(strip_tags($username)));
$valide_password = trim((strip_tags($password)));

//Check if username or password is not empty
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($valide_username) && !empty($valide_password)) {
    
    //Chosing the role
    if($valide_username == "admin" && $valide_password == "admin") {
        $role = "admin";
    } else { $role = "user";}

    //Insert the user into DB
    $query = "INSERT IGNORE INTO `users`(name, username, password, role) VALUES ('$valide_name', '$valide_username', '$valide_password', '$role')";
    $result = mysqli_query($conn, $query);

    //Check if user added seccefully
    if(mysqli_affected_rows($conn) == 1) {

        //Get user id
        $user_id = mysqli_insert_id($conn);

        //Add user in session
        $_SESSION['user_id'] = $user_id;

        //Give role to user
        if($valide_username == "admin" && $valide_password == "admin") {
            $_SESSION['user_role'] = "admin";
        } else {
            echo "Give User";    
            $_SESSION['user_role'] = "user";
        }

        //Redirectio
        header("location: login.php");
    } else if(mysqli_affected_rows($conn) == 0) {
        $_SESSION['register'] = "Username Alraedy Exists";
    } else {
        $_SESSION['register'] = "Account not Added";
    }

} else {
    echo "Username Or Password Is Empty";
}
?>