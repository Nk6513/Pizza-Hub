<?php

// Connecting Database
$conn = mysqli_connect('localhost', 'root', '', 'nas-pizzas');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>