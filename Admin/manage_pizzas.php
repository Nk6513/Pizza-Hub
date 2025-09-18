<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include('../config/db_connect.php');

// Fetch pizzas from database
$sql = "SELECT * FROM pizzas";
$result = mysqli_query($conn, $sql);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

// Handle pizza deletion
if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $sql = "DELETE FROM pizzas WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: manage_pizzas.php?message=deleted");
        exit();
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
}

// Import header
include '../templates/dashboard_header.php';
?>

<section>
    <div class="container grey-text">
        <h3 class="center blue-text">Manage Pizzas</h3>

        <!-- Optional search box -->
        <div class="row">
            <div class="input-field col s12 m6">
                <input type="text" id="search" placeholder="Search by name or ID">
            </div>
        </div>

        <!-- Pizza list -->
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
                <?php foreach ($pizzas as $pizza) : ?>
                    <tr>
                        <td><?= htmlspecialchars($pizza['id']); ?></td>
                        <td><?= htmlspecialchars($pizza['title']); ?></td>
                        <td><?= htmlspecialchars($pizza['ingredients']); ?></td>
                        <td>$<?= htmlspecialchars($pizza['price']); ?></td>
                        <td>
                            <a href="add.php?edit_id=<?= $pizza['id']; ?>" class="btn blue">Edit</a>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="delete" value="<?= $pizza['id']; ?>"/>
                                <button type="submit" class="btn red">Delete</button>  
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>          
            </tbody>
        </table>
    </div>
</section>

<?php include '../templates/dashboard.footer.php'; ?>
