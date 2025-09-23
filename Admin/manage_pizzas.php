<?php 

//===============================================================
// MANAGE PIZZAS
//===============================================================


//---------------------------------------------------------------
// Start session and check login
//---------------------------------------------------------------
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}


//---------------------------------------------------------------
// Connect to Database
//---------------------------------------------------------------
include('../config/db_connect.php');


//---------------------------------------------------------------
// Fetch pizzas from database
//---------------------------------------------------------------
$sql     = "SELECT * FROM pizzas";
$result  = mysqli_query($conn, $sql);
$pizzas  = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);


//---------------------------------------------------------------
// Handle Pizza Deletion
//---------------------------------------------------------------
if (isset($_POST['delete'])) {
    $id     = (int) $_POST['delete'];
    $sql    = "DELETE FROM pizzas WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: manage_pizzas.php?message=deleted");
        exit();
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
}


//---------------------------------------------------------------
// Import Header
//---------------------------------------------------------------
include '../templates/dashboard_header.php';

?>


<!--=============================================================
=  MANAGE PIZZAS TABLE
==============================================================-->
<div class="container grey-text">

    <!-- Page Title -->
    <h3 class="center teal-text">Manage Pizzas</h3>

    <div class="center">
        <!-- Decorative line (optional) -->
        <!-- <div style="width:80px; height:3px; background:#26a69a; margin:10px auto 20px; border-radius:2px;"></div> -->
    </div>

    <!-- Pizza Table -->
    <table class="highlight responsive-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Ingredients</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pizzas as $pizza): ?>
                <tr>
                    <!-- Pizza ID -->
                    <td><?php echo htmlspecialchars($pizza['id']); ?></td>

                    <!-- Pizza Title -->
                    <td><?php echo htmlspecialchars($pizza['title']); ?></td>

                    <!-- Pizza Ingredients -->
                    <td><?php echo htmlspecialchars($pizza['ingredients']); ?></td>

                    <!-- Pizza Price -->
                    <td>$<?php echo htmlspecialchars($pizza['price']); ?></td>

                    <!-- Actions -->
                    <td>
                        <a href="add.php?edit_id=<?php echo $pizza['id']; ?>" class="btn blue">
                            Edit
                        </a>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete" value="<?php echo $pizza['id']; ?>"/>
                            <button type="submit" class="btn red">Delete</button>  
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>          
        </tbody>
    </table>
</div>


<?php include '../templates/dashboard.footer.php'; ?>
