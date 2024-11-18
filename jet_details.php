<?php
// Include database connection
include 'db_connect.php';

// Get the jet ID from the URL (passed as a query string parameter)
if (isset($_GET['id'])) {
    $jet_id = intval($_GET['id']); // Ensure the id is an integer to prevent SQL injection

    // Fetch the jet details from the database based on the provided ID
    $query = "SELECT * FROM jets WHERE id = $jet_id";
    $result = $conn->query($query);

    // Check if the jet exists
    if ($result->num_rows > 0) {
        $jet = $result->fetch_assoc();
    } else {
        $jet = null; // Jet not found
    }
} else {
    $jet = null; // No jet ID provided
}

// Include the Twig autoloader and setup
require_once 'vendor/autoload.php'; // Include Twig if it's installed with Composer

$loader = new \Twig\Loader\FilesystemLoader('templates'); // Path to your templates directory
$twig = new \Twig\Environment($loader);

echo $twig->render('jet_details.twig', ['jet' => $jet]); // Pass jet data to Twig template
?>
