<?php
include("../config/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
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

$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "email_exists";
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>