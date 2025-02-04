<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Initialize the message variable
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007acc;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .header .logout-btn:hover {
            background-color: #d32f2f;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007acc;
            color: white;
        }
        .actions button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .add-btn {
            margin: 20px 0;
            display: inline-block;
            background-color: #007acc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-btn:hover {
            background-color: #005f99;
        }
        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            color: #4CAF50;
            background-color: #dff2bf;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="logout-btn">Odhlásit se</a>
    </div>
    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <a href="add_game.php" class="add-btn">Přidat Hru</a>
        <a href="user_management.php" class="add-btn">Správa Uživatelů</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Název</th>
                    <th>Žánr</th>
                    <th>Popis</th>
                    <th>Hodnocení</th>
                    <th>Cena</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display games from the database
                if ($mysqli) {
                    $result = $mysqli->query("SELECT * FROM hry");
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                        <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['genre']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['rating']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?> €</td>
                            <td class="actions">
                                <a href="edit_game.php?id=<?php echo $row['id']; ?>">
                                    <button class="edit-btn">Editovat</button>
                                </a>
                                <a href="delete_game.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Opravdu chcete tuto hru smazat?');">
                                    <button class="delete-btn">Smazat</button>
                                </a>
                            </td>
                        </tr>
                <?php endwhile;
                    $result->free();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
                