<?php 
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['username'] ?? 'Admin';

include("../config/db_connect.php");

// Pizzas count 
$countSql   = "SELECT COUNT(*) FROM pizzas";
$result     = mysqli_query($conn, $countSql);
$countPizzas = mysqli_fetch_assoc($result);
mysqli_free_result($result);

// Fetch most recent pizza
$nameSql = "SELECT title, created_at, email FROM pizzas ORDER BY created_at DESC LIMIT 1";
$result  = mysqli_query($conn, $nameSql);

if ($result && mysqli_num_rows($result) > 0) {
    $pizzas      = mysqli_fetch_assoc($result);
    $recentPizza = $pizzas['title'];
    $created_at  = $pizzas['created_at'];
    $email       = $pizzas['email'];
} else {
    echo "<h3>No pizza found</h3>";
}

// mysqli_close($conn);
?>

<?php include("../templates/dashboard_header.php"); ?>

<div class="row" style="display:flex; flex-wrap:wrap; align-items:stretch;">

    <!-- Total Pizzas -->
    <div class="col s12 m4" style="display:flex;">
        <div class="card blue lighten-4 z-depth-2 card-stats" 
             style="flex:1; display:flex; flex-direction:column; justify-content:center;">
            <div class="card-content" style="text-align:center;">
                <h5 class="blue-text text-darken-3">Total Pizzas</h5>
                <h3 class="blue-text text-darken-4">
                    <?php echo implode(',', $countPizzas); ?>
                </h3>
            </div>
        </div>
    </div>

    <!-- Pending Orders -->
    <div class="col s12 m4" style="display:flex;">
        <div class="card amber lighten-4 z-depth-2 card-stats" 
             style="flex:1; display:flex; flex-direction:column; justify-content:center;">
            <div class="card-content" style="text-align:center;">
                <h5 class="amber-text text-darken-3">Pending Orders</h5>
                <h3 class="amber-text text-darken-4">2</h3>
            </div>
        </div>
    </div>

    <!-- Recent Pizza -->
    <div class="col s12 m4" style="display:flex;">
        <div class="card green lighten-4 z-depth-2 card-stats" 
             style="flex:1; display:flex; flex-direction:column; justify-content:center;">
            <div class="card-content" style="text-align:center;">
                <h5 class="green-text text-darken-3" style="margin-top: -3px;">Recent Pizza</h5>
                <h6 class="green-text text-darken-4" 
                    style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <?php echo $recentPizza; ?>
                </h6>
                <p style="margin:0; font-size:0.85rem;">
                    Created at: <?php echo $created_at; ?>
                </p>
                <p style="margin:0; font-size:0.85rem;">
                    Email: <?php echo $email; ?>
                </p>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col s12">
        <h5>Quick Actions</h5>
        <a href="add.php" class="btn orange z-depth-0">Add Pizza</a>
        <a href="manage_pizzas.php" class="btn blue z-depth-0">Manage Pizzas</a>
    </div>
</div>

<?php include("../templates/dashboard.footer.php"); ?>
