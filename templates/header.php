<?php 

session_start();

 $_SESSION['name'] = 'Admin'; // Admin name

# QUERY_STRING is used to check in url if certian value is equall to |index.php?noname | then unset the session variable

if($_SERVER['QUERY_STRING'] == 'noname') { 

  unset($_SESSION['name']); // Deleting the session variable

}

// Session variable is stored locally in $name variable and if the session var is unset :
// we are using "Null Coalescing" operator to  give an optional value

 $name = $_SESSION['name'] ?? 'Guest'; 


 // --------------------------------------------------------------------------------------- //


?>



<head>
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
  </style>
</head>

<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="/pizza-hub/index.php" class="brand-logo brand-text">Nas Pizza</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <li class="grey-text">Hello <?php  echo htmlspecialchars($name) ?> </li>
        <li><a href="/pizza-hub/Admin/login.php" class="btn brand z-depth-0">Admin Panel</a></li>
      </ul>
    </div>
  </nav>
