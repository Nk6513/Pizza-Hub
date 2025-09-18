<?php 


session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Not logged in, redirect to login
    header("Location: login.php");
    exit();
}



include('../config/db_connect.php');

$email = $title = $ingredients = $price= "";
$errors = array('email' => '', 'title' => '', 'ingredients' => '', 'price' => '');

if(isset($_POST['submit'])){
	
	// Check Email
	if(empty($_POST['email'])) {
		$errors['email'] = 'An email is required';
	} else {
		$email = $_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Email must be a valid email address';
		}
	}

	// Check Title
	if(empty($_POST['title'])){
		$errors['title'] = 'A title is required';
	} else {
		$title = $_POST['title'];
		if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
			$errors['title'] = 'Title must be letters and spaces only';
		}
	}

	// Check Ingredients
	if(empty($_POST['ingredients'])){
		$errors['ingredients'] = 'At least one ingredient is required';
	} else {
		$ingredients = $_POST['ingredients'];
		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
			$errors['ingredients'] = 'Ingredients must be a comma separated list';
		}
	}

	// Check Price
	if(empty($_POST['price'])) {
		$errors['price'] = 'Price has to be set';
	} else {
		$price = floatval($_POST['price']);
		if(!is_numeric($price) || $price <= 0) {
        $errors['price'] = 'Price must be a positive number or decimal';
    	}
	}
	

	// If no errors
	if(!array_filter($errors)){

		// Escape data safely
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);

		// Update the form feilds
		if(!empty($_POST['update_id'])) {
			$id = mysqli_real_escape_string($conn, $_POST['update_id']);
			//update query
			$sql = "UPDATE pizzas SET email = '$email', title = '$title', ingredients = '$ingredients', price = $price WHERE id = $id";
			$result = mysqli_query($conn, $sql);
			if($result) {
				header("Location: ../index.php");
				exit();
			}
		} else {

		// Insert query
		$sql = "INSERT INTO pizzas (email, title, ingredients, price, created_at) 
		        VALUES ('$email', '$title', '$ingredients', '$price', NOW())";
		$result = mysqli_query($conn, $sql);

		// Save to db and check
		if($result) {
			header("Location: ../index.php");
			exit();
		} else {
			echo 'Query error: ' . mysqli_error($conn);
		}
		
}
		
	}
}

# Retereiving edit data in the form from database 

$pizza = [
    'email' => '',
    'title' => '',
    'ingredients' => '',
    'price' => ''
];

if(isset($_GET['edit_id'])) {

	$id= mysqli_real_escape_string($conn, $_GET['edit_id']);

	$sql = "SELECT * FROM pizzas WHERE id=$id";

	$result = mysqli_query($conn, $sql);

	if($result) {
		$pizzaFromDb = mysqli_fetch_assoc($result);
		$pizza = $pizzaFromDb;
	}

	mysqli_free_result($result);

}

 ?>
<?php include("../templates/dashboard_header.php"); ?>
<!--  -->

	<section class="container grey-text">
   <h4 class="center teal-text text-darken-2">
  <?php echo isset($_GET['edit']) ? 'Edit Pizza' : 'Add a Pizza'; ?>
</h4>
<div class="center">
  <div style="width:80px; height:3px; background-color:#009688; margin:10px auto 20px; border-radius:2px;"></div>
</div> <!-- <div style="display: flex; justify-content: center;">
			<a href="dashboard.php" class="btn grey">Back to Dashboard</a>
		</div> -->
	<?php if($pizza) : ?>
    <form class="white z-depth-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
        <label>Your Email</label>
       		 <input type="text" name="email" value="<?php echo htmlspecialchars($pizza['email']); ?>">
        <div class="red-text"><?php echo $errors['email'] ?? ''; ?></div>
        
        <label>Pizza Title</label>
       		 <input type="text" name="title" value="<?php echo htmlspecialchars($pizza['title']); ?>">
        <div class="red-text"><?php echo $errors['title'] ?? ''; ?></div>
        
        <label>Ingredients (comma separated)</label>
        	<input type="text" name="ingredients" value="<?php echo htmlspecialchars($pizza['ingredients']); ?>">
        <div class="red-text"><?php echo $errors['ingredients'] ?? ''; ?></div>
        
        <label>Price</label>
       		 <input type="text" name="price" value="<?php echo htmlspecialchars($pizza['price']); ?>">
        <div class="red-text"><?php echo $errors['price'] ?? ''; ?></div>

		<?php if (!empty($pizza['id'])): ?>
    		<input type="hidden" name="update_id" value="<?php echo htmlspecialchars($pizza['id']); ?>">
		<?php endif; ?>

        <div class="center">
            <input type="submit" name="submit" value="<?php echo isset($_GET['edit_id']) ? 'Update' : 'Submit'; ?>" class="btn teal z-depth-0">
        </div>		
    </form>
	<?php endif ?>
 </section>
<?php include '../templates/dashboard.footer.php'; ?>

<style>

	.brand{
            /* background: #cbb09c !important; */
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