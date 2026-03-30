<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Verify ownership: user can only view their own complaints
$stmt = $conn->prepare("SELECT * FROM complaints WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if (!$data) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Complaint</title>
    <link rel="stylesheet" href="../assets/css/view.css">
</head>
<body>

<div class="container">

    <h2>Complaint Details</h2>

    <div class="detail">
        <span class="label">Title:</span>
        <?php echo htmlspecialchars($data['title']); ?>
    </div>

    <div class="detail">
        <span class="label">Description:</span>
        <?php echo htmlspecialchars($data['description']); ?>
    </div>

    <div class="detail">
        <span class="label">Status:</span>
        <span class="status <?php echo strtolower($data['status']); ?>">
            <?php echo htmlspecialchars($data['status']); ?>
        </span>
    </div>

    <div class="detail">
        <span class="label">Date:</span>
        <?php echo htmlspecialchars($data['created_at']); ?>
    </div>

    <button class="back-btn" onclick="window.location.href='dashboard.php'">
        Back
    </button>

</div>

</body>
</html>