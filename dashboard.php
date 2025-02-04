<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
include 'db_connection.php';

// Fetch username for display
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';

// Fetch games from the database
$games = [];
$query = "SELECT * FROM hry";
$result = $mysqli->query($query);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            color: #333;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007acc;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            align-items: center;
        }
        .welcome-text {
            font-size: 18px;
            margin: 0;
        }
        .logout-button {
            padding: 8px 16px;
            font-size: 16px;
            text-decoration: none;
            background-color: white;
            color: #007acc;
            border-radius: 4px;
            border: 1px solid white;
            transition: background-color 0.3s, color 0.3s;
        }
        .logout-button:hover {
            background-color: #005f99;
            color: white;
            cursor: pointer;
        }
        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #007acc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007acc;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <p class="welcome-text">Welcome, <?php echo $username; ?>!</p>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </header>
    <div class="content">
        <h1>Welcome to Your Dashboard</h1>
        <p>Below is a list of available games:</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Description</th>
                    <th>Rating</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($games) > 0): ?>
                    <?php foreach ($games as $game): ?>
                        <tr>
                            <td><?php echo $game['id']; ?></td>
                            <td><?php echo htmlspecialchars($game['name']); ?></td>
                            <td><?php echo htmlspecialchars($game['genre']); ?></td>
                            <td><?php echo htmlspecialchars($game['description']); ?></td>
                            <td><?php echo htmlspecialchars($game['rating']); ?></td>
                            <td><?php echo htmlspecialchars($game['price']); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No games available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
