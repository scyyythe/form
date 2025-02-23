<?php
require_once '../config/connection.php';
require_once '../model/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user = new User($conn);
    $user_id = $_POST['delete_user'];

    if ($user->delete($user_id)) {
        header("Location: ../views/dataView.php?success=Deleted Successfully");
    } else {
        header("Location: ../views/dataView.php?error=Failed to Delete user");
    }
    exit();
} else {
    echo "Invalid request.";
    exit();
}
