<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-white">
  
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
    <div class="navbar-nav ms-auto">
        <a  href="register.php" class="nav-link text-decoration-none text-primary fw-bold">Create Account  <i class="bi bi-person-plus-fill"></i></a>
    </div>
</div>
  </div>
</nav>


<div class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 120px);">
  <form action="login_action.php" method="POST" enctype="multipart/form-data" class="card shadow-lg p-4 rounded-4" style="max-width: 500px; width:100%;">
    
    <h3 class="text-center mb-4">Login</h3>

    <!-- INPUTS -->
    <div class="mb-3">
      <input name="username" type="text" class="form-control form-control-lg" placeholder="Username" required>
    </div>
    <div class="mb-3">
      <input name="password" type="password" class="form-control form-control-lg" placeholder="Password" required>
    </div>

    <!-- Session -->
     <label class="mb-2" style="color: rgb(222, 0, 0);"><?php
      if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      };?>
      </label>


    <hr>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-success btn-lg" style="color: rgb(255, 255, 255);">Login</button>
    </div>

    <!-- Link Create Account -->
     <br>
    <div class="text-center">
      <a href="register.php" class=" text-primary">Create Account</a>
    </div>

  </form>
</div>


<center>
    Developed by Ait Lahcen Hassan
</center>
<br>
</body>
</html>
