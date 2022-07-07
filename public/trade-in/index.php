<!DOCTYPE html>
<html>
<head>
	<title>Trade In</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	    <!-- BootStrap CSS CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- JavaScript CDN For BootStrap  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="shortcut icon" href="//www.jd.id/favicon.ico">

   <style>
        .logo {
           display: inline-block;
           margin-left: auto;
           margin-right: auto;
        }
        .rule h3 {
           margin-left: 30px;
        }
        .rule p {
           margin-left: 50px;
        }

        #images{
           text-align:center;
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
         <div class="form-group">
            <select onchange="setType(this.value)" id="type_list" class="custom-select">
               <option>Select Type</option>
            </select>
         </div>
         <div class="form-group">
            <select onchange="setBrand(this.value)" id="brand_list" class="custom-select">
               <option>Select Brand</option>
            </select>
         </div>
         <div class="form-group">
            <select onchange="setVariantName(this.value)" id="variant_name_list" class="custom-select">
               <option>Select Variant Name</option>
            </select>
         </div>

         <div id="price" style="text-align: center;">
            <p>Pilih Type, Brand dan Variant Name untuk menampilkan Grade.</p>
         </div>
      </div>
   </div>
   <div class="rule">
      <h3>
      Ketentuan Grading 
      </h3>
      <p>
      -Grade A : Body Mulus tidak ada lecet
      </p>
      <p>
      -Grade B : Lecet halus, lecet 2 – 4 titik, jika ada lecet parah akan turun (Grade C) 
      </p>
      <p>
      -Grade C : Lecet parah, Dent/ Penyok lebih dari 4 titik
      </p>
   </div>

    
    <script>
         $('.custom-select').select2();
    </script>
    <script type="text/javascript" src="asset/js/getType.js"></script>
    <script type="text/javascript" src="asset/js/getBrand.js"></script>
    <script type="text/javascript" src="asset/js/getVariantName.js"></script>
    <script type="text/javascript" src="asset/js/getPrice.js"></script>
</body>

</html>