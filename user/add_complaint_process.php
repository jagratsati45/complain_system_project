<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_complaint.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$title = isset($_POST['title']) ? trim($_POST['title']) : "";
$description = isset($_POST['description']) ? trim($_POST['description']) : "";

if ($title === "" || $description === "") {
    header("Location: add_complaint.php");
    exit();
}

$stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description, status) VALUES (?, ?, ?, 'Pending')");
$stmt->bind_param("iss", $user_id, $title, $description);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>