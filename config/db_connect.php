<?php

// Connecting Database
$connection = mysqli_connect('localhost', 'nakhan','1234','nas-pizzas');

// Checking Connection to Database
if (!$connection) 	{
	echo 'Connection error:' . mysqli_connect_error();
}

?>