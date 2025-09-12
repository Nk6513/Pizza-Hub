
<?php 

include('config/db_connect.php');

// Query to fetch pizzas data from database 
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

// Get the result set of pizzas
$result = mysqli_query($connection, $sql);

// fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the $result from memory
mysqli_free_result($result);

// Close connection 
mysqli_close($connection);

?>

<!DOCTYPE html>
<html>
	
	<?php include'templates/header.php'; ?>

	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<img src="img/pizza.svg"class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $pizza['ingredients']) as $ing) : ?>
									<li><?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="admin/payment.php?id=<?php echo $pizza['id'] ?>">more info</a>
						</div>
					</div>
				</div>			
			<?php endforeach; ?>

			<!-- <?php if(count($pizzas) >= 3) : ?>
			 <p> There are more than 3 pizzas! </p>
			 
			<?php else :  ?>
		     <p> There are less than 3 pizzas!</p>

			<?php endif; ?> -->

		</div>
	</div>
    
	<?php include 'templates/footer.php'; ?>

</html>
