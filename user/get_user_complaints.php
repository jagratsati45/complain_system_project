<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM complaints WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>