<?php
include "connect.php"; // Include your database connection script
include "layout.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you're also sending the 'id' of the product to update
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $newQuantity = isset($_POST['newquantity']) ? intval($_POST['newquantity']) : null;

    // Validate the new quantity
    if ($newQuantity !== null && $newQuantity >= 0) {
        // Prepare the update statement
        $sql = "UPDATE stock SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $newQuantity, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Quantity updated successfully.";
            } else {
                echo "No record updated. Check if the product ID exists.";
            }
        } else {
            echo "Error in preparing the statement.";
        }
    } else {
        echo "Invalid quantity. Please provide a non-negative number.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
