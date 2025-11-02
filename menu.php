<?php include './templates/header.php'; ?>

<?php 
include('config/db_connect.php');
 
// Query pizzas
$sql = 'SELECT title, ingredients, id, price FROM pizzas ORDER BY created_at';
$result = mysqli_query($conn, $sql);

$pizzas = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
if ($result) mysqli_free_result($result);
mysqli_close($conn);
?>

<!-- small CSS fix for image centering -->
<style>
    .pizza-card .card-image {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px 0;
        background-color: #fafafa;
    }

    .pizza-card .card-image img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .pizza-card .card-content ul {
        margin: 0;
        padding-left: 1.2rem;
    }
</style>

<div class="container">
    <h4 class="center grey-text text-darken-2" style="margin-top: 24px;">Our Menu</h4>

    <div class="row">
        <?php if (!empty($pizzas)): ?>
            <?php foreach ($pizzas as $pizza): ?>
                <div class="col s12 m6 l4">
                    <div class="card pizza-card hoverable">

                        <!-- Image centered at top -->
                        <div class="card-image">
                            <img src="img/pizza.svg" alt="<?php echo htmlspecialchars($pizza['title']); ?>">
                        </div>

                        <!-- Card Content -->
                        <div class="card-content center">
                            <span class="card-title grey-text text-darken-4" style="font-size: 1.3rem;">
                                <?php echo htmlspecialchars($pizza['title']); ?>
                            </span>
                            <ul class="grey-text text-darken-1">
                                <?php foreach (explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars(trim($ing)); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Card Action -->
                        <div class="card-action" style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="black-text" style="font-weight: 600;">
                                $<?php echo htmlspecialchars($pizza['price']); ?>
                            </span>
                            <a href="admin/payment.php?pizza_id=<?php echo urlencode($pizza['id']); ?>"
                                class="btn-small brand z-depth-0 waves-effect waves-light">
                                Buy
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col s12">
                <div class="card-panel yellow lighten-5 center">
                    <p class="grey-text">No pizzas available at the moment.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include './templates/footer.php'; ?>