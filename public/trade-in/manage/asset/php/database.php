<?php

$host = "zfix.id"; /* Host name */
$user = "zfixdbremote"; /* User */
$password = "zfixdb12345"; /* Password */
$db = "trade_in"; /* Database name 1 */

$conn = mysqli_connect($host, $user, $password,$db);
// Check connection
if ($conn) {

}else{
    die("Connection failed: " . mysqli_connect_error());
}

