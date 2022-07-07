<?php
  include_once 'database.php';

  if($_POST['tag']=='typeList')
  {
    $query = "SELECT DISTINCT type FROM price";

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

  // Getting item list on the basis of company_id
  if($_POST['tag']=='brandList')
  {
    $type = $_POST['type'];

    $query = "select DISTINCT brand from price where type ='".$type."'" ;

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

  // Getting model list on the basis of item_id
  if($_POST['tag']=='variantNameList')
  {
    $type = $_POST['type'];
    $brand = $_POST['brand'];

    $query = "select variant_name from price where type ='".$type."' and brand ='".$brand."'" ;

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