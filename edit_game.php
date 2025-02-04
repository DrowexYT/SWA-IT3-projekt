<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Validate the game ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid game ID.");
}

$game_id = intval($_GET['id']);

// Fetch the existing game details
$game = null;
if ($mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM hry WHERE id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $game = $result->fetch_assoc();
    $stmt->close();
}

if (!$game) {
    die("Game not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];

    // Update the game details in the database
    $stmt = $mysqli->prepare("UPDATE hry SET name = ?, genre = ?, description = ?, rating = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sssdii", $name, $genre, $description, $rating, $price, $game_id);
    if ($stmt->execute()) {
        $success = "Hra byla úspěšně aktualizována!";
    } else {
        $error = "Chyba při aktualizaci hry: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editovat Hru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            color: #333;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #007acc;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea, button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007acc;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #005f99;
        }
        .error, .success {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }
        .error {
            color: #d8000c;
            background-color: #ffbaba;
        }
        .success {
            color: #4f8a10;
            background-color: #dff2bf;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editovat Hru</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="edit_game.php?id=<?php echo $game_id; ?>" method="post">
            <label for="name">Název hry</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($game['name']); ?>" required>

            <label for="genre">Žánr</label>
            <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($game['genre']); ?>" required>

            <label for="description">Popis</label>
            <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($game['description']); ?></textarea>

            <label for="rating">Hodnocení</label>
            <input type="number" id="rating" name="rating" value="<?php echo htmlspecialchars($game['rating']); ?>" min="0" max="10" step="0.1" required>

            <label for="price">Cena</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($game['price']); ?>" min="0" step="0.01" required>

            <button type="submit">Uložit Změny</button>
        </form>
    </div>
</body>
</html>
