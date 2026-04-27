<?php
session_start();
include("../config/db.php");
include("../config/department_helper.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "invalid_request";
    exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : "";
$password = $_POST['password'] ?? "";
$login_type = $_POST['login_type'] ?? "general";

if ($email === "" || $password === "") {
    echo "empty";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalid_email";
    exit();
}

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    if ($login_type === "department" && $user['role'] !== "department") {
        echo "invalid_department";
        exit();
    }

    if ($login_type === "general" && $user['role'] === "department") {
        echo "use_department_login";
        exit();
    }

    if ($user['role'] === 'department') {
        $department_id = get_department_id_for_user($conn, intval($user['id']), $user['name']);

        if ($department_id <= 0) {
            echo "department_not_linked";
            exit();
        }
    }

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['name'];

    if ($user['role'] == 'admin') {
        echo "admin";
    } else if ($user['role'] == 'department') {
        echo "department";
    } else {
        echo "user";
    }
} else {
    echo "invalid";
}
?>
