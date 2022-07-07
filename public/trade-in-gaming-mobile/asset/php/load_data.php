<?php
  include_once 'database.php';

  if($_POST['tag']=='brandList')
  {

    $query = "select DISTINCT brand from price where type ='Mobile' and is_gaming = '1'" ;

    $result = mysqli_query($con,$query);

    $arr =[];
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
      $arr[$i] = $row;
      $i++;
    }

    echo json_encode($arr);
  }

  if($_POST['tag']=='variantNameList')
  {

    $brand = $_POST['brand'];

    $query = "select variant_name from price where brand = '".$brand."' and type ='Mobile' and is_gaming = '1'" ;

    $result = mysqli_query($con,$query);

    $arr =[];
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
      $arr[$i] = $row;
      $i++;
    }

    echo json_encode($arr);
  }

  if($_POST['tag']=='priceList')
  {
    $variant_name = $_POST['variant_name'];

    $query = "select grade_a, grade_b, grade_c from price where variant_name ='".$variant_name."'" ;

    $result = mysqli_query($con,$query);

    $arr =[];
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
      $arr[$i] = $row;
      $i++;
    }
	
    echo json_encode($arr);
  }

   
?>