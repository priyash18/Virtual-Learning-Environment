<?php
$conn=new mysqli("localhost", "root", "", "educonnect");
if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
?>