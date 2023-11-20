<?php 
include "connect.php";
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
$query = "SELECT id, name, quantity FROM stock";
$result = $conn->query($query);
$conn->close();
include "layout.php"; 
?>

<table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                if ($isLoggedIn) {
                    echo "<td><a href='edit.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></td>";
                } else {
                    echo "<td>" . $row["name"] . "</td>";
                }
                echo "<td>" . $row["quantity"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No products found</td></tr>";
        }
        ?>
    </table>

</body>
</html>