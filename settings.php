<?php
session_start();
include 'db_connect.php'; 

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email or password needs updating
    if (!empty($email)) {
        // Update email
        $update_email_query = "UPDATE users SET email = ? WHERE id = ?";
        $update_email_stmt = $conn->prepare($update_email_query);
        $update_email_stmt->bind_param("si", $email, $user_id);
        $update_email_stmt->execute();
    }

    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        // Verify current password
        $password_query = "SELECT password FROM users WHERE id = ?";
        $password_stmt = $conn->prepare($password_query);
        $password_stmt->bind_param("i", $user_id);
        $password_stmt->execute();
        $password_result = $password_stmt->get_result();
        $password_data = $password_result->fetch_assoc();

        if (password_verify($current_password, $password_data['password'])) {
            if ($new_password === $confirm_password) {
                // Update password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_query = "UPDATE users SET password = ? WHERE id = ?";
                $update_password_stmt = $conn->prepare($update_password_query);
                $update_password_stmt->bind_param("si", $hashed_password, $user_id);
                $update_password_stmt->execute();
                $success_message = "Password updated successfully.";
            } else {
                $error_message = "New password and confirm password do not match.";
            }
        } else {
            $error_message = "Current password is incorrect.";
        }
    }

    $success_message = $success_message ?? "Details updated successfully.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="settings.css">
</head>
<body>
<div id="settings-page">
    <h2>Account Settings</h2>

    <?php if (isset($success_message)) echo "<p style='color: green;'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>

    <form method="POST" action="settings.php">
        <label for="username">Username:</label>
        <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <h3>Change Password</h3>
        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" id="current_password">

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password">

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password">

        <button type="submit" class="btn">Update</button>
    </form>

    <p><a href="user_dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
