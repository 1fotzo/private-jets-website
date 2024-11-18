<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if username or email already exists
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "Username or email already exists. Please try a different one.";
    } else {
        // Insert new user
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($query) === TRUE) {
            // Redirect to login page after successful registration
            header('Location: user_login.php');
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

