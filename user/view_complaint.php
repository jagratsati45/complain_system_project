<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

$query = "SELECT * FROM complaints WHERE id='$id'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);
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
        <?php echo $data['title']; ?>
    </div>

    <div class="detail">
        <span class="label">Description:</span>
        <?php echo $data['description']; ?>
    </div>

    <div class="detail">
        <span class="label">Status:</span>
        <span class="status <?php echo strtolower($data['status']); ?>">
            <?php echo $data['status']; ?>
        </span>
    </div>

    <div class="detail">
        <span class="label">Date:</span>
        <?php echo $data['created_at']; ?>
    </div>

    <button class="back-btn" onclick="window.location.href='dashboard.php'">
        Back
    </button>

</div>

</body>
</html>