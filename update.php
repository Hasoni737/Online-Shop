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

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
}
$result = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $id");
$product = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Update</title>
  <link href="style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .product_image {
            width: 100%;
            height: 200px;
            object-fit: contain; /* تظهر بالكامل */
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
  <form action="update_action.php" method="POST" enctype="multipart/form-data" class="card shadow-lg p-4 rounded-4" style="max-width: 500px; width:100%;">
    
    <h3 class="text-center mb-4">Update</h3>

    <img class="product_image" src="images/<?php echo $product['image'] ?>" alt="Product Image">
    <br>

    <input type="hidden" name="old_image" value="<?php echo $product['image']; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <!-- INPUTS -->
    <div class="mb-3">
      <input value="<?php echo $product['name'] ?>" name="name" type="text" class="form-control form-control-lg" placeholder="Product name" required>
    </div>
    <div class="mb-3">
      <input value="<?php echo $product['price'] ?>" name="price" type="number" class="form-control form-control-lg" placeholder="Product price" required>
    </div>

    <!-- Image Input -->
    <div class="mb-3">
        <label for="formFile" class="form-label image_label">Product image</label>
        <input name="image" class="form-control" type="file" id="formFile" require>
    </div>

    <!-- Session -->
     <label class="mb-2" style="color: rgb(222, 0, 0);"><?php
      if(isset($_SESSION['alert'])){
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
      };?>
      </label>
     <label class="mb-2" style="color: rgb(0, 177, 24);"><b><?php
      if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      };
      ?><b>
      </label>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-success btn-lg">Update</button>
    </div>


  </form>
</div>
</body>
</html>
