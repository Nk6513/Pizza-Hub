
<?php

# Turnery Operator 

// $score = 40;

// echo $score > 30 ? 'High Score' : 'Low Score';


# Super Gloabals


// echo $_SERVER['SERVER_NAME'] . '<br/>'; // Show server name

// echo $_SERVER['SCRIPT_FILENAME'] . '<br/>'; // Show complete path to the file

// echo $_SERVER['REQUEST_METHOD'] . '<br/>'; // Show requested method , Can be GET or POST

// echo $_SERVER['PHP_SELF'] . '<br/>'; //  load the current file by default with update name if it the filename is changed

//==========================================================================


# SESSION SUPER GLOBAL

// $_SESSION['']; A temporary variable stored on the SERVER SIDE


// if(isset($_POST['submit'])) {


//     # COOKIES SUPER GLOBAL

// // $_cOOKIES['']; A temporary variable stored on the CLIENT SIDE

// // first we need to set the cookie using | setcookie(variable name, value, time to expire)

//     setcookie('gender', $_POST['gender'], time() + 86400);

//     session_start();

//     $_SESSION['name'] = $_POST['name'];

//     header('Location: index.php');
// }


//==========================================================================











?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php // echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="name">
    <select name="gender">
			<option value="male">male</option>
			<option value="female">female</option>
		</select>
    <input type="submit" name="submit" value="submit">
</form>
    
</body>
</html>