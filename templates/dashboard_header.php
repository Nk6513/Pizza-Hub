<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = $_SESSION['username'] ?? 'Guest';
$logged_in = $_SESSION['logged_in'] ?? false;
?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style>
.brand {background: #cbb09c !important;}
.sidebar { min-height: 100vh; background: #fff; padding-top: 20px; }
.sidebar a { display: block; margin: 10px 0; }
.card-stats { text-align: center; padding: 20px; }
</style>
</head>
<body>
<nav class="teal z-depth-0">
    <div class="container">
        <a href="#" class="brand-logo">Nas Pizza Admin</a>
        <ul class="right hide-on-small-and-down">
            <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li>
            <li><a href="logout.php" class="btn teal z-depth-3">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="row">
    <!-- Sidebar -->
    <div class="col s3 sidebar z-depth-2 grey lighten-4" style="padding: 20px; border-radius: 8px;">
        <div class="center-align" style="margin-bottom: 20px;">
            <h6 class="grey-text text-darken-2">👋 Welcome, <?php echo htmlspecialchars($name); ?></h6>
            <div class="divider"></div>
        </div>

        <a href="dashboard.php" class="waves-effect waves-light btn-large blue lighten-1 white-text" style="width: 100%; margin: 8px 0; text-align: left;">
            🏠 Dashboard
        </a>
        <a href="manage_pizzas.php" class="waves-effect waves-light btn-large green lighten-1 white-text" style="width: 100%; margin: 8px 0; text-align: left;">
            🍕 Manage Pizzas
        </a>
        <a href="add.php" class="waves-effect waves-light btn-large amber darken-2 white-text" style="width: 100%; margin: 8px 0; text-align: left;">
            ➕ Add Pizza
        </a>
    </div>
     <!-- Page content -->
    <div class="col s9">


   


    
