<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "root123456789";
  $dbase = "recordsapp";


  $conn = new mysqli($servername, $username, $password, $dbase);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>