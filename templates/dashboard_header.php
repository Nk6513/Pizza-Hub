<?php 

//===============================================================
// DASHBOARD HEADER
//===============================================================


//---------------------------------------------------------------
// Start Session
//---------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name       = $_SESSION['username'] ?? 'Guest';
$logged_in  = $_SESSION['logged_in'] ?? false;

?>


<!--=============================================================
=  HTML HEADER
==============================================================-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Header</title>

    <!-- Materialize CSS -->
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Custom Styles -->
    <style>
        .brand {
            background: #cbb09c !important;
        }
        .brand-text {
            color: #cbb09c !important;
        }
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

        .sidebar { 
            min-height: 100vh; 
            background: #fff; 
            padding-top: 20px; 
        }
        .sidebar a { 
            display: block; 
            margin: 10px 0; 
        }
        .card-stats { 
            text-align: center; 
            padding: 20px; 
        }
    </style>
</head>


<!--=============================================================
=  BODY & NAVBAR
==============================================================-->
<body>
<header>
    <nav class="teal grey z-depth-0">
        <div class="container">
            <a href="#" class="brand-logo">Nas Pizza Admin</a>
            <ul class="right hide-on-small-and-down">
                <li class="white-text">
                    Hello <?php echo htmlspecialchars($name); ?>
                </li>
                <li>
                    <a href="logout.php" class="btn teal z-depth-3">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<!--=============================================================
=  MAIN LAYOUT
==============================================================-->
<section>
    <div class="row">

        <!--=====================================================
        =  SIDEBAR
        =====================================================-->
        <div class="col s3 sidebar z-depth-2 grey lighten-4" 
             style="padding:20px; border-radius:8px; display:flex; flex-direction:column; justify-content:flex-start; height:auto; min-height:100%;">

            <!-- Welcome Block -->
            <div class="center-align teal lighten-3 z-depth-1" 
                 style="padding:15px; border-radius:8px; margin-bottom:20px;">
                <h6 class="white-text" style="margin:0;">
                    👋 Welcome, <?php echo htmlspecialchars($name); ?>
                </h6>
                <div class="divider" 
                     style="background-color:rgba(255,255,255,0.5); margin-top:10px;">
                </div>
            </div>

            <!-- Sidebar Buttons -->
            <a href="dashboard.php" 
               class="waves-effect waves-light btn-large green lighten-1 white-text" 
               style="width:100%; margin:8px 0; text-align:left;">
                🏠 Dashboard
            </a>

            <a href="add.php" 
               class="waves-effect waves-light btn-large amber darken-2 white-text" 
               style="width:100%; margin:8px 0; text-align:left;">
                ➕ Add Pizza
            </a>

            <a href="manage_pizzas.php" 
               class="waves-effect waves-light btn-large blue lighten-1 white-text" 
               style="width:100%; margin:8px 0; text-align:left;">
                🍕 Manage Pizzas
            </a>

            <a href="manage_orders.php" 
               class="waves-effect waves-light btn-large pink lighten-1 white-text" 
               style="width:100%; margin:8px 0; text-align:left;">
                📝 Manage Orders
            </a>
        </div>


        <!--=====================================================
        =  PAGE CONTENT AREA (Open)
        =====================================================-->
        <div class="col s9">
