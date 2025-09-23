<?php 

//===============================================================
// MANAGE ORDERS
//===============================================================


//---------------------------------------------------------------
// Start session and check login
//---------------------------------------------------------------
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}


//---------------------------------------------------------------
// Connect to Database
//---------------------------------------------------------------
include('../config/db_connect.php');


//---------------------------------------------------------------
// Fetch all orders from database
//---------------------------------------------------------------
$sql     = "SELECT * FROM orders";
$results = mysqli_query($conn, $sql);

$records = [];
if ($results) {
    $records = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_free_result($results);
}

?>


<?php include('../templates/dashboard_header.php'); ?>


<!--=============================================================
=  MANAGE ORDERS TABLE
==============================================================-->
<div class="container">

    <!-- Page Title -->
    <h4 class="center teal-text" style="margin-top:20px;">Manage Orders</h4>

    <div class="center">
        <!-- Decorative line (optional) -->
        <!-- <div style="width:80px; height:3px; background:#26a69a; margin:10px auto 20px; border-radius:2px;"></div> -->
    </div>

    <!-- Search Field -->
    <div class="row">
        <div class="input-field col s12 m6">
            <input type="text" id="search" placeholder="Search by name or ID">
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row">
        <div class="col s12">
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <!-- Order ID -->
                            <td><?php echo htmlspecialchars($record['id']); ?></td>

                            <!-- Customer Name -->
                            <td><?php echo htmlspecialchars($record['customer_name']); ?></td>

                            <!-- Email -->
                            <td><?php echo htmlspecialchars($record['email']); ?></td>

                            <!-- Address -->
                            <td><?php echo htmlspecialchars($record['address']); ?></td>

                            <!-- Status Toggle -->
                            <td>
                                <form method="POST" action="dashboard.php" 
                                      style="display:flex; gap:5px; align-items:center;">
                                    <input type="hidden" name="update-status" 
                                           value="<?php echo $record['id']; ?>">

                                    <?php
                                    // Default to Pending if empty
                                    $status = $record['status'] ?? 'Pending';

                                    if (strtolower($status) === 'pending'): ?>
                                        <button type="submit" name="status" value="Completed" 
                                                class="btn amber">
                                            Pending
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" name="status" value="Pending" 
                                                class="btn green">
                                            Delivered
                                        </button>
                                    <?php endif; ?>
                                </form>
                            </td>

                            <!-- Created At -->
                            <td><?php echo htmlspecialchars($record['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<?php include('../templates/dashboard.footer.php'); ?>
