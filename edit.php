<?php
include "connect.php";
include "layout.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM stock WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No record found.";
        }
    } else {
        echo "Error in preparing statement.";
    }
} else {
    header("Location: index.php");
    exit();
}
$conn->close();
?>
Edit the item
<table>
<tr>
    <form name="updatestock" method="post" action="updatestock.php">
    <?php
        echo '<td>'.$row["id"]."</td>";
        echo '<td>'.$row["name"]."</td>";
        echo '<td><input name="newquantity" min=0 placeholder='.$row["quantity"]."></input></td>";
        echo '<input type="hidden" name=id value='.$id.'></input>';
    ?>
    <td><button type="submit">Update stock</button></td>
    </form>
</tr>
</table>