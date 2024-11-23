<?php

require_once 'vendor/autoload.php';

include 'db_connect.php';

// Fetch the jet data and pass it to the Twig template
$query = "SELECT id, model_name, manufacturer, price, capacity, image FROM jets WHERE 1=1";

// Check if search criteria are provided and modify the query accordingly
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $price = (int)$_GET['price'];
    $query .= " AND price <= $price";
}

if (isset($_GET['capacity']) && !empty($_GET['capacity'])) {
    $capacity = (int)$_GET['capacity'];
    $query .= " AND capacity >= $capacity";
}

if (isset($_GET['model']) && !empty($_GET['model'])) {
    $model = $conn->real_escape_string($_GET['model']);
    $query .= " AND model_name LIKE '%$model%'";
}

$result = $conn->query($query);

$jets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jets[] = $row;
    }
}

// Create a Twig environment
$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/templates');  
$twig = new Twig\Environment($loader);

// Render the template with the jet data
echo $twig->render('jets.twig', ['jets' => $jets]);

$conn->close();

?>
