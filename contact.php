<?php
include 'db_connect.php';

// Initialize success message variable
$successMessage = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    $jet_id = isset($_POST['jet_id']) ? (int)$_POST['jet_id'] : null;

    // Insert form data into a 'contacts' table
    $query = "INSERT INTO contacts (name, email, message, jet_id) VALUES ('$name', '$email', '$message', " . ($jet_id ? $jet_id : 'NULL') . ")";

    if ($conn->query($query)) {
        // If the query is successful, display success message
        $successMessage = "Thank you for reaching out! We’ll get back to you soon.";
    } else {
        // If there was an error in the database query
        $successMessage = "There was an issue submitting your message. Please try again later.";
    }

    $conn->close();
}

// Create a Twig environment
require_once 'vendor/autoload.php';
$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new Twig\Environment($loader);

// Render the template with the success message
echo $twig->render('contact.twig', ['successMessage' => $successMessage]);
?>
