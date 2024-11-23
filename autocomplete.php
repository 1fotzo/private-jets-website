<?php
require_once 'db_connect.php';

// Check if 'model' parameter is set
if (isset($_GET['model'])) {
    $model = $conn->real_escape_string($_GET['model']);

    // Query to search for models matching the input
    $query = "SELECT model_name FROM jets WHERE model_name LIKE '%$model%' LIMIT 5";
    $result = $conn->query($query);

    $jets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jets[] = $row;  // Store matching jets
        }
    }

    // Return results as JSON
    echo json_encode($jets);
}

$conn->close();
?>
