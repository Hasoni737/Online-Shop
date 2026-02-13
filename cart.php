<?php 
include "connect_to_db.php";

session_start();

//Check if is user
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit();
}


//Get items
$query = "
SELECT 
    cart_items.user_id,
    cart_items.id,
    cart_items.product_id,
    cart_items.quantity,
    products.id product_id,
    products.name,
    products.price,
    products.image,
    products.created_at
FROM cart_items
JOIN products ON cart_items.product_id = products.id
WHERE cart_items.user_id = ".$_SESSION['user_id'].";
";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .cart-img {
        width: 80px;
        border-radius: 10px;
        }

        .cart-title {
        font-size: 15px;
        font-weight: 500;
        }

        .cart-qty {
        width: 70px;
        text-align: center;
        }

        .cart-table th {
        font-weight: 600;
        color: #555;
        }

        .cart-table td {
        vertical-align: middle;
        }

        .cart-table tbody tr {
        border-bottom: 1px solid #eee;
        }

    </style>
</head>
<body>
    

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
        <a class="nav-link" aria-current="page" href="products.php">Products</a>
        <a class="nav-link" aria-current="page" href=""></a>
        <a class="nav-link active" href="">Cart <i class="bi bi-cart-fill"></i></a>
    </div>
    <div class="navbar-nav ms-auto">
        <a  href="logout.php" class="nav-link text-decoration-none text-danger fw-bold">Logout <i class="bi bi-box-arrow-left"></i></a>
    </div>
</div>
</div>
</nav>


<div class="container mt-5">
  <table class="table align-middle cart-table">
    <thead class="border-bottom">
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    <?php 
        while($row = mysqli_fetch_assoc($result)){
            echo '
            
                <tr>
                    <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="images/'.$row['image'].'" class="cart-img">
                        <span class="cart-title">'.$row['name'].'</span>
                    </div>
                    </td>

                    <!-- Price -->
                    <td class="fw-bold">'.$row['price'].'$</td>

                    <!-- Quantity -->
                    <td>
                    <input type="number" value="1" min="1" class="form-control cart-qty" disabled>
                    </td>

                    <!-- Subtotal -->
                    <td class="fw-bold">'.$row['price'].'$</td>

                    <!-- Delete -->
                    <td>
                    <a href="delete_cart_action.php?id='.$row['id'].'"'.'><i class="bi fs-4 bi-trash-fill" style="color: #555;"></i></a>
                    </td>
            </tr>
            ';
        }
    ?>



    </tbody>
  </table>

  <div class="text-end">
    <button class="btn btn-danger px-4">Confirm the order</button>
  </div>
</div>

</body>
