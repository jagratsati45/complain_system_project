<?php
$conn = mysqli_connect("localhost", "root", "", "complaint_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;
