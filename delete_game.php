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

// Delete the game from the database
if ($mysqli) {
    $stmt = $mysqli->prepare("DELETE FROM hry WHERE id = ?");
    $stmt->bind_param("i", $game_id);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=Hra byla úspěšně smazána!");
        exit;
    } else {
        die("Chyba při mazání hry: " . $stmt->error);
    }
    $stmt->close();
}
?>
