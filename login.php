<?php
session_start();
include "connect.php";
include "layout.php";
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (!isset($_POST['username']) || !isset($_POST['password'])){
        echo "Please fill out the 'username and password field.";
    }
    else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo 'Logged in successfully.';
            header("Location: index.php");
            exit();
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'Username does not exist.';
    }
    }
    
}
else{
    echo '
    <form name="loginform" method="POST" action="login.php">
        <label for="username">Username</label>
        <input name="username"><br>
        <label for="password">Passowrd</label>
        <input type="password" name="password"><br>
        <button action="submit">Login</button>
    </form>
    ';
}
$conn->close();
?>