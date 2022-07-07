<?php
	// cek apakah sudah login
    
	session_start();
	if($_SESSION['status']!="login"){
		header("location:login.php?session_status=not_login");
	}

// Load the database configuration file
include_once 'asset/php/database.php';

?>

<html>
   
   <head>
      <title>Trade In</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
   <script type="text/javasctipt" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <link rel="shortcut icon" href="//www.jd.id/favicon.ico">

   <style>


#images{
           text-align:center;
        }

        .dataTables_wrapper:after {
            display: none !important;
        }

        table.dataTable>thead .sorting:before, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_desc_disabled:before {
            display: none !important;
        }

        table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:after {
            display: none !important;
        } 
        
        .dataTables_wrapper .dataTables_length select, .dataTables_wrapper .dataTables_filter input {
            background-color: #fff !important;
        }
</style>

   </head>
<body>
    
<h1 style="margin-top: 10px;   text-align: center;">Trade In</h1>
<div id="images">
    <img class="logo" src="https://www.jd.id/news/wp-content/uploads/2020/06/JDID_4-1024x1024.png" alt="" style="height: 150px;">
    </div>
   
<div class="container">
<div class="jumbotron">
<div class="row justify-content-center">
    <div class="col-md-12">
    <?php 
        if(isset($_GET['import_price_status'])){
          if($_GET['import_price_status'] == "success"){
            echo "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Import csv berhasil.
                    </div>";
          }else if($_GET['import_price_status'] == "fail"){
            echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Import csv gagal.
                    </div>";
          }
        }
?>
    </div>
  </div>
        <div class="panel panel-default">
            <div class="panel-body">
            <a href="logout.php" class="btn btn-danger text-white float-right" >Logout</a>
                <form action="asset/php/import_price.php" method="post" enctype="multipart/form-data" id="import_form" class="float-left">				
                        <a href="asset/csv/template-import-price.csv">Download Template Import Price CSV</a><br>
                        <input type="file" name="file" required="required" accept=".csv"/><br>
                            
                        
                        <input type="submit" class="btn btn-primary" name="import_price" style="margin-top:1em" value="Import Price">
                    		
                </form>

               

                <!-- <a href="logout.php">LOGOUT</a> -->

		    </div>

<div class="table" style="margin-bottom:0;">



   <table id="price" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Model</th>
                <th>Variant Name</th>
                <th>Grade A</th>
                <th>Grade B</th>
                <th>Grade C</th>
            </tr>
        </thead>
        <tbody>
        <?php
 
         $no = 1;
         $query = "SELECT * FROM price";

         if($result = mysqli_query($conn, $query)){
            if(mysqli_num_rows($result) > 0){
              while ($row = mysqli_fetch_array($result)){

        echo '
        <tr>

         <td>'.$no++.'</td>
         <td>'.$row['type'].'</td>
         <td>'.$row['brand'].'</td>
         <td>'.$row['variant_name'].'</td>
         <td>Rp. '.$row['grade_a'].'</td>
         <td>Rp. '.$row['grade_b'].'</td>
         <td>Rp. '.$row['grade_c'].'</td>

        </tr>';
        ?>

        <?php }?>

        </tbody>
         <!-- closing the if mysqli_num_rows if statement -->    
         <?php } else { echo "No record found"; }?>
    <!-- closing the if $result = mysqli_query($connection, sql) if statement -->   
    <?php } else {
        die("Database query failed. ". mysqli_error($conn));
    } ?>
    </table>
</div>
<br>

        </div>
    </div>
</div>
</div>
   
</body>
</html>

<script>

$(document).ready(function() {
    $('#price').DataTable();
    
});
</script>