<?php
include "connect_to_db.php";

session_start();

//Check if is user
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");


// Add button "add new products" id is admin
if($_SESSION['user_role'] == "admin") {
    $add_product = '
        <a  href="index.php" class="nav-link text-decoration-none text-primary fw-bold" style="padding-right: 20px;">Add Product <i class="bi bi-plus-circle-fill"></i></a>
    ';
} else {
    $add_product = "";
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<!-- NavBar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img src="logo/logo2.png" alt="Bootstrap" width="150" height="36">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Products</a>
        <a class="nav-link active" aria-current="page" href=""></a>
        <a class="nav-link" href="cart.php">Cart <i class="bi bi-cart-fill"></i></a>
    </div>
    <div class="navbar-nav ms-auto">
        <?php echo $add_product; ?>
        <a  href="logout.php" class="nav-link text-decoration-none text-danger fw-bold">Logout <i class="bi bi-box-arrow-left"></i></a>

    </div>
</div>
  </div>
</nav>

<!-- Products -->
<div class="container mt-4">
    <div class="row g-3">
    <?php 
    $buttons = "";
    $cart_button = "";
    while($row = mysqli_fetch_assoc($result)) {
        if($_SESSION['user_role'] == "admin") {
            $buttons = '
                <!-- Buttons Full Width Side by Side -->
                <div class="mt-auto d-flex justify-content-between">
                    <a href="delete.php?id='.$row['id'].'&image='.$row['image'].'" class="btn btn-danger" >Delete</a>
                    <a href="update.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
                </div>
            ';
            $cart_button = "";
            } else {
                $cart_button = '
                    <div class="mt-auto d-flex justify-content-between">
                        <a href="add_cart_action.php?id='.$row['id'].'&name='.$row['name'].'" class="btn btn-warning" style="width: 96%;">Add to cart</a>
                    </div>
                ';
                $buttons = "";
                $add_product = "";
            }
        echo '
        <!-- Product Card Start -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <img src="images/'.$row['image'].'" alt="Product Image">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">'.$row['name'].'</h6>
                    <p class="card-text text-success">'.$row['price'].'$</p>
                    <p class="card-text"><small class="text-muted">Added on: '.date("Y-m-d", strtotime($row['created_at'])).'</small></p>
                    '.$buttons.$cart_button.'
                </div>
            </div>
        </div>
        <!-- Product Card End -->
        ';};
        ?>
        </div>
</div>
</div>
<br><br>
<center>
    Developed by Ait Lahcen Hassan
</center>
<br>
</body>