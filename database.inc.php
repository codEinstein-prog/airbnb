<?php 

$serverName="LocalHost";
$dbUsername="root";
$dbPassword="";
$dbName="airbnbproject";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName );

if(!conn){
  die("connection failed: ". mysqli_connect_error());
}
