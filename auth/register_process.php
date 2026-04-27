<?php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "invalid_request";
    exit();
}

$name = isset($_POST['name']) ? trim($_POST['name']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";
$password = $_POST['password'] ?? "";
$confirm = $_POST['confirm_password'] ?? "";

if ($name === "" || $email === "" || $password === "" || $confirm === "") {
    echo "empty";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalid_email";
    exit();
}

if ($password != $confirm) {
    echo "password_mismatch";
    exit();
}

if (strlen($password) < 6) {
    echo "weak_password";
    exit();
}

if (strlen($name) < 2) {
    echo "invalid_name";
    exit();
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "email_exists";
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$admin_check = $conn->query("SELECT id FROM users WHERE role='admin' LIMIT 1");
$role = ($admin_check && $admin_check->num_rows === 0) ? "admin" : "user";

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $hashed, $role);

if ($stmt->execute()) {
    if ($role === "admin") {
        echo "success_first_admin";
    } else {
        echo "success";
    }
} else {
    echo "error";
}
?>