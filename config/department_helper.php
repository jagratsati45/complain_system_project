<?php
function departments_has_user_id($conn)
{
    static $has_user_id = null;

    if ($has_user_id !== null) {
        return $has_user_id;
    }

    $check = $conn->query("SHOW COLUMNS FROM departments LIKE 'user_id'");
    $has_user_id = ($check && $check->num_rows > 0);

    return $has_user_id;
}

function get_department_id_for_user($conn, $user_id, $user_name)
{
    if (departments_has_user_id($conn)) {
        $stmt = $conn->prepare("SELECT id FROM departments WHERE user_id=? LIMIT 1");
        $stmt->bind_param("i", $user_id);
    } else {
        $stmt = $conn->prepare("SELECT id FROM departments WHERE name=? LIMIT 1");
        $stmt->bind_param("s", $user_name);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row ? intval($row['id']) : 0;
}
?>