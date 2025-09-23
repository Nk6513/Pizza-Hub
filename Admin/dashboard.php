<?php 

//===============================================================
// DASHBOARD 
//===============================================================


//---------------------------------------------------------------
// Check login session
//---------------------------------------------------------------
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}


//---------------------------------------------------------------
// Display admin username
//---------------------------------------------------------------
$name = $_SESSION['username'] ?? 'Admin';


//---------------------------------------------------------------
// Connect to Database
//---------------------------------------------------------------
include("../config/db_connect.php");


//---------------------------------------------------------------
// Count total pizzas in pizzas table
//---------------------------------------------------------------
$countSql    = "SELECT COUNT(*) FROM pizzas";
$result      = mysqli_query($conn, $countSql);
$countPizzas = mysqli_fetch_assoc($result);
mysqli_free_result($result);


//---------------------------------------------------------------
// Fetch most recent pizza order for dashboard display
//---------------------------------------------------------------
$recentOrders = "
    SELECT 
        o.customer_name, 
        o.created_at, 
        o.email,
        o.address, 
        p.title AS pizza_title
    FROM orders o
    INNER JOIN pizzas p ON o.pizza_id = p.id
    ORDER BY o.created_at DESC  
    LIMIT 1
";

$result = mysqli_query($conn, $recentOrders);

$buyerName    = $buyerAddress = $created_at = $buyerEmail = $pizzaName = "N/A";

if ($result && mysqli_num_rows($result) > 0) {
    $order        = mysqli_fetch_assoc($result);
    $buyerName    = $order['customer_name'];
    $buyerAddress = $order['address'];
    $created_at   = $order['created_at'];
    $buyerEmail   = $order['email'];
    $pizzaName    = $order['pizza_title']; // ✅ Recent pizza name
} else {
    // echo "<h3>No orders found</h3>";
}

mysqli_free_result($result);


//---------------------------------------------------------------
// Count total orders
//---------------------------------------------------------------
$countOrders = "SELECT COUNT(*) FROM orders";
$result      = mysqli_query($conn, $countOrders);
$totaOrders  = mysqli_fetch_assoc($result);
mysqli_free_result($result);


//---------------------------------------------------------------
// Change status of the record from 'Pending' to 'Delivered'
//---------------------------------------------------------------

if(isset($_POST['update-status'], $_POST['status'])) {
    $id = (int)$_POST['update-status'];
    $newStatus = (trim($_POST['status'])); // ensure "Pending" / "Completed"

   // Run update query and check for errors
    $sql = "UPDATE orders SET status='$newStatus' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Database update failed: " . mysqli_error($conn));
    }
}

// Fetch counts for dashboard tiles
$deliveredResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status='Completed'");
$deliveredRow = mysqli_fetch_assoc($deliveredResult);
$deliveredRecords = $deliveredRow['total'];

$pendingResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status='Pending'");
$pendingRow = mysqli_fetch_assoc($pendingResult);
$pendingRecords = $pendingRow['total'];

mysqli_close($conn);

?>

<?php include("../templates/dashboard_header.php"); ?>

<div class="row" style="display:flex; flex-wrap:wrap; align-items:stretch;">

    <!-- Total Pizzas Card -->
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

    <!-- Total Orders Card -->
    <div class="col s12 m4" style="display:flex;">
        <div class="card amber lighten-4 z-depth-2 card-stats" 
             style="flex:1; display:flex; flex-direction:column; justify-content:center;">
            <div class="card-content" style="text-align:center;">
                <h5 class="amber-text text-darken-3">Total Orders</h5>
                <h3 class="amber-text text-darken-4"><?php echo implode(',', $totaOrders); ?></h3>
            </div>
        </div>
    </div>

    <!-- Recent Order Card -->
    <div class="col s12 m4" style="display:flex;">
        <div class="card green lighten-4 z-depth-2 card-stats" 
             style="flex:1; display:flex; flex-direction:column; justify-content:center;">
            <div class="card-content" style="text-align:center;">
                <h5 class="green-text text-darken-3" style="margin-top: -3px;">Recent Order</h5>
                <h6 class="green-text text-darken-4" 
                    style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <?php echo $pizzaName; ?>
                </h6>
                <p style="margin:0; font-size:0.85rem;">Name: <?php echo $buyerName; ?></p>
                <p style="margin:0; font-size:0.85rem;">Email: <?php echo $buyerEmail; ?></p>
                <p style="margin:0; font-size:0.85rem;">Address: <?php echo $buyerAddress; ?></p>
                <p style="margin:0; font-size:0.85rem;">Ordered at: <?php echo $created_at; ?></p>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <!-- Pending Orders Card -->
    <div class="col s12 m4">
        <div class="card red lighten-4 z-depth-2">
            <div class="card-content center">
                <h5 class="red-text text-darken-3">Pending Orders</h5>
                <h4><?php echo $pendingRecords ?? 0;  ?></h4> <!-- Placeholder count -->
            </div>
        </div>
    </div>

    <!-- Completed Orders Card
    <div class="col s12 m4">
        <div class="card blue lighten-4 z-depth-2">
            <div class="card-content center">
                <h5 class="blue-text text-darken-3">Completed Orders</h5>
                <h4>30</h4>
            </div>
        </div>
    </div> -->

    <!-- Delivered Orders Card -->
    <div class="col s12 m4">
        <div class="card green lighten-4 z-depth-2">
            <div class="card-content center">
                <h5 class="green-text text-darken-3">Delivered Orders</h5>
                <h4><?php echo $deliveredRecords ?? 0; ?></h4>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Section -->
<div class="row">
    <div class="col s12">
        <div class="card yellow lighten-4 z-depth-2">
            <div class="card-content">
                <h5 class="yellow-text text-darken-3">Recent Orders</h5>
                <ul class="collection">
                    <li class="collection-item">
                        <span class="title">Margherita Pizza</span>
                        <p>John Doe — john@example.com<br>Ordered at: 2025-09-20</p>
                    </li>
                    <li class="collection-item">
                        <span class="title">Pepperoni</span>
                        <p>Jane Smith — jane@example.com<br>Ordered at: 2025-09-19</p>
                    </li>
                    <li class="collection-item">
                        <span class="title">Veggie Delight</span>
                        <p>Mark Lee — mark@example.com<br>Ordered at: 2025-09-18</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include("../templates/dashboard.footer.php"); ?>
