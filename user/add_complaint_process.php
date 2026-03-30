<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$title = $_POST['title'];
$description = $_POST['description'];

$stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description, status) VALUES (?, ?, ?, 'Pending')");
$stmt->bind_param("iss", $user_id, $title, $description);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>