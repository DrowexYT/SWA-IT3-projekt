<?php
include 'db_connection.php';

// Start session
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úvodní stránka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #4682b4;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .user-info {
            font-size: 16px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            background-color: #5a9bd4;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .navbar a:hover {
            background-color: #4a8ac1;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            color: #4682b4;
        }
        .content p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="user-info">
            Přihlášen jako: <strong><?php echo htmlspecialchars($username); ?></strong>
        </div>
        <a href="logout.php">Odhlásit se</a>
    </div>
    <div class="content">
        <h1>Vítejte na úvodní stránce</h1>
        <p>Pokud čtete tento text, znamená to, že jste přihlášeni!</p>
    </div>
</body>
</html>
