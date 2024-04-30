<?php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Names = $_POST['Names'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Gender = $_POST['Gender'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    if (strlen($Password) < 4 || !preg_match("/[A-Za-z]/", $Password) || !preg_match("/\d/", $Password)) {
        echo "Password must be at least 4 characters long and contain at least one letter and one number";
        exit();
    }

    $Password = password_hash($Password, PASSWORD_DEFAULT);

    $Role = $_POST['Role'];
    $activation_code = $_POST['activation_code'];

    $sql = "INSERT INTO user (Names, Email, Phone, Gender, Username, Password, Role, activation_code) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssss", $Names, $Email, $Phone, $Gender, $Username, $Password, $Role, $activation_code);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>