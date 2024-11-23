<?php

require_once 'vendor/autoload.php';

include 'db_connect.php';

// Fetch featured jets from the database
$query = "SELECT id, model_name, manufacturer, price, image FROM jets LIMIT 3";
$result = $conn->query($query);

// Create an array to store the jet data
$jets = [];

// Check if there are any jets to display
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jets[] = $row;
    }
}

// Start session to check user login status
session_start();

// Create a Twig environment
$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new Twig\Environment($loader);

// Pass the necessary variables to the template
echo $twig->render('index.twig', [
    'jets' => $jets,                       // Jet data for the featured jets section
    'is_logged_in' => isset($_SESSION['user_id']), // Login status (true or false)
    'user_id' => $_SESSION['user_id'] ?? null  // Pass the user ID if logged in, otherwise null
]);

?>