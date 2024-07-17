<?php
session_start();
include 'db.php';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!empty($username) && !empty($password)) {
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
    } else {
        $error_message = "Login gagal. Username atau password salah.";
        header("location: index.html?error=" . urlencode($error_message));
        exit;
    }

    $stmt->close();
} else {
    $error_message = "Mohon isi username dan password.";
    header("location: index.html?error=" . urlencode($error_message));
    exit;
}

$conn->close();
?>
