<?php
include('db_connection.php');

if ($mysqli) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed!";
}
?>