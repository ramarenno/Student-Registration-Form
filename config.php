<?php 

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "students_db";

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
$conn = new mysqli($db_host, $db_user, $db_pass);


if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

