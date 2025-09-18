<?php 

include('config/db_connect.php');

// Query to fetch pizzas data from database 
$sql = 'SELECT title, ingredients, id, price FROM pizzas ORDER BY created_at';

// Get the result set of pizzas
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the $result from memory
mysqli_free_result($result);

// Close connection 
mysqli_close($conn);

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
						<div class="card-action" style="display: flex; justify-content: space-between; align-items: center;">
  							<p class="black-text" style="padding: 5px 10px; border-radius: 5px; font-weight: bold;">Price: $ <?php echo  htmlspecialchars($pizza['price']);  ?></p>
 							<a class="btn brand z-depth-0 right" name="payment" href="admin/payment.php?id=<?php echo $pizza['id'] ?>">Buy</a>
						</div>						
					</div>
				</div>			
			<?php endforeach; ?>
		</div>
	</div> 
	<?php include 'templates/footer.php'; ?>
</html>
