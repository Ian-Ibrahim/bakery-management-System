

<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "BMS_3.0";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if($conn){
   // echo "Connected Successfully \r\n";
}
else{
    echo "\r\nDid not connect" .mysqli_connect_error();
}

// if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
// {

// 	die("failed to connect!");
// }



// else{
//     echo"Connected succesfully";
// };
?>


