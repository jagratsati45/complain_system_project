<?php
session_start();
$conn = require __DIR__ . "/../config/db.php";
include("../config/department_helper.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit();
}

$id = isset($_POST['complaint_id']) ? intval($_POST['complaint_id']) : 0;
$status = isset($_POST['status']) ? trim($_POST['status']) : "";

$allowed_statuses = ['In Progress', 'Resolved'];
if ($id <= 0 || !in_array($status, $allowed_statuses, true)) {
    header("Location: dashboard.php");
    exit();
}

$department_id = get_department_id_for_user($conn, intval($_SESSION['user_id']), $_SESSION['name']);

if ($department_id <= 0) {
    header("Location: dashboard.php");
    exit();
}

$stmt = $conn->prepare("UPDATE complaints SET status=? WHERE id=? AND department_id=?");
$stmt->bind_param("sii", $status, $id, $department_id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>