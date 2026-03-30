<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_POST['complaint_id'];
$dept_id = $_POST['department_id'];

$stmt = $conn->prepare("UPDATE complaints SET department_id=?, status='Assigned' WHERE id=?");
$stmt->bind_param("ii", $dept_id, $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>