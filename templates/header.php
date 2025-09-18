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
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        .pizza{
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="/pizza-hub/index.php" class="brand-logo brand-text">Nas Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li>         
                <?php if ($logged_in): ?>
                    <li><a href="/pizza-hub/Admin/logout.php" class="btn red z-depth-0">Logout</a></li>
                <?php else: ?>
                    <li><a href="/pizza-hub/Admin/login.php" class="btn brand z-depth-0">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
