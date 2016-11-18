<?php

$servername = "192.168.159.128";
$username="gamp_db_user";
$password = "gamp_db_user";
$dbname = "gamp_dp";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    
    die("Connection failed: " .$conn->connect_error);
}
echo "Connected successfully";
echo '<br>';
