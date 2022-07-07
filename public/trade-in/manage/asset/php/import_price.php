<?php
include_once("database.php");
if(isset($_POST['import_price'])){    
    // validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){

        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
            fgetcsv($csv_file);            
            // get data records from csv file
            while(($record = fgetcsv($csv_file, 10000, ";")) !== FALSE){
                // Check if data already exists with same variant_name
                $sql_query = "SELECT type, brand, variant_name, grade_a, grade_b, grade_c FROM price WHERE variant_name = '".$record[2]."'";

                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));

				// if data already exist then update details otherwise insert new record
                if(mysqli_num_rows($resultset)) {                     
				$sql_update = "UPDATE price set grade_a='".$record[3]."',  grade_b='".$record[4]."', grade_c='".$record[5]."' WHERE variant_name = '".$record[2]."'";
                mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));

                } else{

				$mysql_insert = "INSERT INTO price (type, brand, variant_name, grade_a, grade_b, grade_c )VALUES('".$record[0]."', '".$record[1]."','".$record[2]."', '".$record[3]."', '".$record[4]."', '".$record[5]."')";
				
                mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                }
            }            

            fclose($csv_file);
            $import_status = '?import_price_status=success';

        } else {

            $import_status = '?import_price_status=error';
        }
        
    } else {
        $import_status = '?import_status=fail';
    //    echo "swal('Hello world!')";
    }
}
header("Location: ../../index.php".$import_status);
?>