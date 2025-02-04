<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the database connection
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];

    // Prepare and bind the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO hry (name, genre, description, rating, price) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param("sssdi", $name, $genre, $description, $rating, $price);

    // Execute the statement
    if ($stmt->execute()) {
        $success = "Hra byla úspěšně přidána!";
    } else {
        $error = "Chyba při přidávání hry: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat Hru</title>
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
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Přidat Hru</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="add_game.php" method="post">
            <label for="name">Název hry</label>
            <input type="text" id="name" name="name" placeholder="Zadejte název hry" required>

            <label for="genre">Žánr</label>
            <input type="text" id="genre" name="genre" placeholder="Zadejte žánr hry" required>

            <label for="description">Popis</label>
            <textarea id="description" name="description" placeholder="Zadejte popis hry" rows="4" required></textarea>

            <label for="rating">Hodnocení</label>
            <input type="number" id="rating" name="rating" placeholder="Zadejte hodnocení (např. 8)" min="0" max="10" step="0.1" required>

            <label for="price">Cena</label>
            <input type="number" id="price" name="price" placeholder="Zadejte cenu (např. 19.99)" min="0" step="0.01" required>

            <button type="submit">Přidat Hru</button>
        </form>
        <div class="back-link">
            <a href="admin_dashboard.php">Zpět na hlavní stránku</a>
        </div>
    </div>
</body>
</html>
