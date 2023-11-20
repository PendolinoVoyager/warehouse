<?php
include "connect.php";
include "layout.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "SELECT * from users where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if ($stmt->get_result()) {
        echo '<a href="index.php">This user already exists!</a>';
    }
    else{
        if ($_POST['confirmpassword'] == $password){
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            header("Location: index.php");
            exit();
        }
        else {
            echo '<a href="register.php">The passwords don\'t match.</a>';
        }
    }
}
else{
    echo'
    <form name="registerform" method="POST" action="register.php">
        <label for="username">Username</label>
        <input name="username"><br>
        <label for="password">Passowrd</label>
        <input type="password" name="password"><br>
        <label for="confirmpassword">Confirm passowrd</label>
        <input type="password" name="confirmpassword"><br>
        <button action="submit">Login</button>
    </form>
    ';
}
$conn->close();
?>
