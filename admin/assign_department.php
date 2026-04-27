<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit();
}

$id = isset($_POST['complaint_id']) ? intval($_POST['complaint_id']) : 0;
$dept_id = isset($_POST['department_id']) ? intval($_POST['department_id']) : 0;

if ($id <= 0 || $dept_id <= 0) {
    header("Location: dashboard.php");
    exit();
}

$dept_check = $conn->prepare("SELECT id FROM departments WHERE id=? LIMIT 1");
$dept_check->bind_param("i", $dept_id);
$dept_check->execute();
$dept_result = $dept_check->get_result();

if ($dept_result->num_rows === 0) {
    header("Location: dashboard.php");
    exit();
}

$stmt = $conn->prepare("UPDATE complaints SET department_id=?, status='Assigned' WHERE id=?");
$stmt->bind_param("ii", $dept_id, $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>