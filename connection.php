<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "notesharingapp";

//Create Connection
$conn = new mysqli($serverName,$userName,$password,$dbName);

//Check Connection
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
//echo "Connected Successfully";

?>