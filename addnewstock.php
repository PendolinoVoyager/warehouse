<?php
include "connect.php";
include "layout.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if (empty($name) || $quantity < 0) {
        echo "Invalid input. Please provide a valid name and non-negative quantity.";
    } else {
        $sql = "INSERT INTO stock (name, quantity) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("si", $name, $quantity);
            $stmt->execute();
            echo "New stock added successfully.";
        } else {
            echo "Error in preparing the statement.";
        }   
    }
}
$conn->close();
?>
<form action="addnewstock.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
        <button type="submit">Add Stock</button>
</form>
