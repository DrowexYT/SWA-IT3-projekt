<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Handle user actions
if (isset($_POST['action'])) {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'remove':
            $mysqli->query("DELETE FROM uzivatele WHERE id = $user_id");
            break;
        case 'make_admin':
            $mysqli->query("UPDATE uzivatele SET role = 'admin' WHERE id = $user_id");
            break;
        case 'make_user':
            $mysqli->query("UPDATE uzivatele SET role = 'user' WHERE id = $user_id");
            break;
    }

    header("Location: user_management.php?message=User+updated+successfully");
    exit;
}

// Display success message if available
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
        <h1>User Management</h1>
        <a href="logout.php" class="logout-btn">Odhlásit se</a>
    </div>
    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <a href="admin_dashboard.php" class="add-btn">Zpět na Admin Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display users from the database
                if ($mysqli) {
                    $result = $mysqli->query("SELECT * FROM uzivatele");
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td class="actions">
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="remove" class="delete-btn" onclick="return confirm('Opravdu chcete tohoto uživatele smazat?');">Smazat</button>
                                </form>
                                <?php if ($row['role'] !== 'admin'): ?>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="make_admin" class="edit-btn">Make Admin</button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="make_user" class="edit-btn">Make User</button>
                                    </form>
                                <?php endif; ?>
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
