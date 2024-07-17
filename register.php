<?php
include 'db.php';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!empty($username) && !empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
    } else {
        echo "Pendaftaran gagal: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Mohon isi username dan password.";
}

$conn->close();
?>
