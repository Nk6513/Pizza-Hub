<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = $_SESSION['username'] ?? 'Guest';
$logged_in = $_SESSION['logged_in'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ninja Pizza</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
    /* Brand styling */
    .brand {
        background: linear-gradient(90deg, #cbb09c, #f2d0a4) !important;
        font-weight: bold;
    }

    .brand-text {
        color: #cbb09c !important;
        font-family: 'Arial', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }

    /* Navbar improvements */
    nav.white {
        padding: 0 20px;
        border-bottom: 2px solid #f2d0a4;
    }

    /* NEW styling for the newly created li and a */
    nav li {
        display: inline-block;
        margin-left: 20px;
        font-weight: 500;
        position: relative;
        transition: all 0.3s;
        cursor: pointer;
    }

    nav li a {
        color: #616161;
        text-decoration: none;
        transition: color 0.3s, transform 0.3s;
        font-weight: 500;
    }

    nav li a:hover {
        color: #cbb09c;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Buttons inside nav (login/logout) */
    nav li .btn {
        border-radius: 25px;
        padding: 0 15px;
        text-transform: uppercase;
        font-weight: 500;
        transition: opacity 0.3s;
    }

    nav li .btn:hover {
        opacity: 0.9;
    }

    /* Logo spacing */
    .brand-logo {
        font-size: 2rem;
        margin-left: 0;
    }

    /* Responsive improvements */
    @media (max-width: 600px) {
        .brand-logo {
            font-size: 1.5rem;
        }

        nav li {
            display: block;
            margin: 5px 0;
        }
    }

    /* Form & pizza image styling (existing) */
    form {
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }

    .pizza {
        width: 100px;
        margin: 40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
    }
</style>

</head>
<body class="grey lighten-4">
  <nav class="white z-depth-1">
    <div class="nav-wrapper container">
        <a href="/pizza-hub/index.php" class="brand-logo brand-text">Nas Pizza</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a class="nav-link" href="/pizza-hub/index.php">Home</a></li>
            <li><a class="nav-link" href="/pizza-hub/menu.php">Menu</a></li>
            <li><a class="nav-link" href="/pizza-hub/contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

