<?php

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
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Online Shop</title>
  <link href="style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
  <form action="insert.php" method="POST" enctype="multipart/form-data" class="card shadow-lg p-4 rounded-4" style="max-width: 500px; width:100%;">
    
    <h3 class="text-center mb-4">Online marketing website 🛒</h3>

    <!-- INPUTS -->
    <div class="mb-3">
      <input name="name" type="text" class="form-control form-control-lg" placeholder="Product name" required>
    </div>
    <div class="mb-3">
      <input name="price" type="number" class="form-control form-control-lg" placeholder="Product price" required>
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
      if(isset($_SESSION['status'])){
        echo $_SESSION['status'];
        unset($_SESSION['status']);
      };
      ?><b>
      </label>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-success btn-lg">Product upload</button>
    </div>

    <hr>

    <div class="text-center">
      <a href="products.php" class="text-decoration-none text-danger fw-bold">View all products</a>
    </div>

  </form>
</div>

</body>
</html>
