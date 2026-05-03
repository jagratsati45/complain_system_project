<?php
session_start();
$conn = require __DIR__ . "/../config/db.php";
include("../config/department_helper.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: create_department.php");
    exit();
}

function set_flash_and_redirect(string $message, string $type = "error", string $path = "create_department.php"): void
{
    $_SESSION['admin_flash_message'] = $message;
    $_SESSION['admin_flash_type'] = $type;
    header("Location: " . $path);
    exit();
}

$department_name = isset($_POST['department_name']) ? trim($_POST['department_name']) : "";
$department_email = isset($_POST['department_email']) ? trim($_POST['department_email']) : "";
$department_password = $_POST['department_password'] ?? "";
$confirm_password = $_POST['confirm_password'] ?? "";

if ($department_name === "" || $department_email === "" || $department_password === "" || $confirm_password === "") {
    set_flash_and_redirect("All department fields are required.");
}

if (!filter_var($department_email, FILTER_VALIDATE_EMAIL)) {
    set_flash_and_redirect("Please enter a valid department email.");
}

if ($department_password !== $confirm_password) {
    set_flash_and_redirect("Department passwords do not match.");
}

if (strlen($department_password) < 6) {
    set_flash_and_redirect("Department password must be at least 6 characters.");
}

$email_check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
$email_check->bind_param("s", $department_email);
$email_check->execute();
$email_result = $email_check->get_result();

if ($email_result->num_rows > 0) {
    set_flash_and_redirect("This email is already registered.");
}

$name_check = $conn->prepare("SELECT id FROM departments WHERE name=? LIMIT 1");
$name_check->bind_param("s", $department_name);
$name_check->execute();
$name_result = $name_check->get_result();

if ($name_result->num_rows > 0) {
    set_flash_and_redirect("This department name already exists.");
}

$hashed_password = password_hash($department_password, PASSWORD_DEFAULT);

$conn->begin_transaction();

try {
    $user_insert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'department')");
    $user_insert->bind_param("sss", $department_name, $department_email, $hashed_password);
    if (!$user_insert->execute()) {
        throw new Exception("Failed to create department user.");
    }

    $department_user_id = $conn->insert_id;

    if (departments_has_user_id($conn)) {
        $dept_insert = $conn->prepare("INSERT INTO departments (name, user_id) VALUES (?, ?)");
        $dept_insert->bind_param("si", $department_name, $department_user_id);
    } else {
        $dept_insert = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
        $dept_insert->bind_param("s", $department_name);
    }

    if (!$dept_insert->execute()) {
        throw new Exception("Failed to map department user.");
    }

    $conn->commit();
    set_flash_and_redirect("Department account created successfully.", "success", "create_department.php");
} catch (Exception $e) {
    $conn->rollback();
    set_flash_and_redirect("Unable to create department account.");
}
?>