<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

$id = $_POST['complaint_id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE complaints SET status=? WHERE id=?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>