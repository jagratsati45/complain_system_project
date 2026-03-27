<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];


$title = $_POST['title'];
$description = $_POST['description'];

$query = "INSERT INTO complaints (user_id, title, description, status)
VALUES ('$user_id', '$title', '$description', 'Pending')";

mysqli_query($conn, $query);

header("Location: dashboard.php");
?>