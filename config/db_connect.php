<?php

// Connecting Database
$conn = mysqli_connect('localhost', 'root', '', 'pizza-hub');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>