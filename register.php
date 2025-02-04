<?php
// Start the session and include the database connection
session_start();
include 'db_connection.php'; // Include your database connection file

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Validate inputs
    if (empty($username) || empty($password) || empty($role)) {
        echo "Všechna pole jsou povinná.";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $query = $mysqli->prepare("INSERT INTO uzivatele (username, password, role) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $hashedPassword, $role);

    if ($query->execute()) {
        echo "Registrace byla úspěšná!";
        header("Location: login.html"); // Redirect to login page after successful registration
        exit;
    } else {
        echo "Chyba: " . $query->error;
    }

    // Close the query
    $query->close();
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #d3d3d3;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4682b4;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"], input[type="password"], select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #d3d3d3;
            border-radius: 5px;
        }
        .register-button {
            display: flex;
            justify-content: center;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4682b4;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #5a9bd4;
        }
        .login-link {
            margin-top: 10px;
            text-align: center;
        }
        .login-link a {
            color: #4682b4;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrace</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Uživatelské jméno" required>
            <input type="password" name="password" placeholder="Heslo" required>
            <select name="role" required>
                <option value="user">Uživatel</option>
                <option value="admin">Admin</option>
            </select>
            <div class="register-button">
                <button type="submit">Zaregistrovat se</button>
            </div>
        </form>

        <div class="login-link">
            <p>Již máte účet? <a href="login.html">Přihlaste se</a></p>
        </div>
    </div>
</body>
</html>
