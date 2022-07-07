<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Trade In | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="//www.jd.id/favicon.ico">
  <style>
        .logo {
           display: inline-block;
           margin-left: auto;
           margin-right: auto;
        }
        #images{
           text-align:center;
        }
   </style>
</head>
<body>
<h1 style="margin-top: 10px;   text-align: center;">Trade In | Login</h1>
<div id="images">
    <img class="logo" src="https://www.jd.id/news/wp-content/uploads/2020/06/JDID_4-1024x1024.png" alt="" style="height: 150px;">
    </div>
    
  <div class="container">
    <div class="jumbotron">
    
  <div class="row justify-content-center">
    <div class="col-md-4">
    <?php 
        if(isset($_GET['session_status'])){
          if($_GET['session_status'] == "fail"){
            echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Login gagal! <br> Email dan password salah.
                      </div>";
          }else if($_GET['session_status'] == "not_login"){
            echo "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            Anda harus login terlebih dahulu.
      </div>";
          }
        }
      ?>
    </div>
  </div>
  <div class="row justify-content-center">
      <div class="col-md-4" style="margin-top:20px">
      
        <form  method="POST">
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <input type="submit" class="btn btn-danger btn btn-block text-white" name="submit" value="Login">
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
<?php 
if (isset($_POST["submit"])) {
  // mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'asset/php/database.php';

// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = md5($_POST['password']);

// menyeleksi data dengan email dan password yang sesuai
$data = mysqli_query($conn,"select * from user where email='$email' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
  $_SESSION['email'] = $email;
  $_SESSION['status'] = "login";
  header("location:index.php");
}else{
  header("location:login.php?session_status=fail");
}
}

?>