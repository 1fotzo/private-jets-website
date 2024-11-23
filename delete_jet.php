<?php
include 'db_connect.php';

// Check if the jet ID is provided
if (isset($_GET['id'])) {
    $jet_id = (int)$_GET['id'];

    // SQL query to delete the jet from the database
    $query = "DELETE FROM jets WHERE id = $jet_id";

    if ($conn->query($query)) {
        echo "<p>Jet deleted successfully!</p>";
    } else {
        echo "<p>Error deleting jet: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
