<?php 
//---------------------------------------------------------------
// INDEX PAGE
//---------------------------------------------------------------
include('config/db_connect.php');

// Query to fetch pizzas data
$sql = 'SELECT title, ingredients, id, price FROM pizzas ORDER BY created_at';
$result = mysqli_query($conn, $sql);

// Fetch as associative array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result memory and close connection
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include './templates/header.php'; ?>

<div class="container">
    <div class="row">

        <?php foreach($pizzas as $pizza): ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">

                    <!-- Pizza Image -->
                    <img src="img/pizza.svg" class="pizza">

                    <!-- Card Content -->
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                        <ul class="grey-text">
                            <?php foreach(explode(',', $pizza['ingredients']) as $ing) : ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Card Action -->
                    <div class="card-action" style="display:flex; justify-content:space-between; align-items:center;">
                        <p class="black-text" 
                           style="padding:5px 10px; border-radius:5px; font-weight:bold;">
                            Price: $<?php echo htmlspecialchars($pizza['price']); ?>
                        </p>
                        <a href="admin/payment.php?pizza_id=<?php echo $pizza['id']; ?>" 
                           class="btn brand z-depth-0 right">
                           Buy
                        </a>
                    </div>

                </div>
            </div>          
        <?php endforeach; ?>

    </div>
</div> 

<?php include 'templates/footer.php'; ?>
