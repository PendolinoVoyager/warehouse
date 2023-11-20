<?php
include "connect.php";
include "layout.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';

    if (empty($id)) {
        echo "Invalid input. Please provide a valid id.";
    } else {
        $sql = "DELETE FROM stock where id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "Deleted stock with id ".$id;
        } else {
            echo "Error in preparing the statement.";
        }   
    }
}
$conn->close();
?>
<form action="deletestock.php" method="post">
        <label for="id">Name:</label>
        <input type="text" name="id" required placeholder="id of the product"><br>
        <button type="Delete">Delete the product</button>
</form>
