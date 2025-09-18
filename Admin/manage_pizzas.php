<?php

session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Not logged in, redirect to login
    header("Location: login.php");
    exit();
}



include('../config/db_connect.php');

# Getting pizzas from database and listing it in a table form

    // Getting pizza by id
    $sql = "SELECT * FROM pizzas";

    // Get the query result
    $result = mysqli_query($conn, $sql);

    // Fetch the result in array format
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Releasing resources associated with query
    mysqli_free_result($result);


# Deleting Pizza

if(isset($_POST['delete'])) {

    $id = mysqli_real_escape_string($conn, $_POST['delete']);

    $sql = "DELETE FROM pizzas WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if($result) {
        // Success
        header("Location: manage_pizzas.php?message=deleted");
        exit();
    } else {
       // Failure
        echo "Query error: " . mysqli_error($conn);
    }





}

// Import Header
include '../templates/dashboard_header.php';
?>

<section>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pizzas</title>
</head>
<body>
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
             <?php foreach($pizzas as $pizza) :  ?>
            <tr>
                <td><?php echo htmlspecialchars($pizza['id']); ?></td>
                <td><?php echo htmlspecialchars($pizza['title']);?></td>
                <td><?php echo htmlspecialchars($pizza['ingredients']); ?></td>
                <td>$<?php echo htmlspecialchars($pizza['price']); ?></td>
                <td>
                    <a href="add.php?edit_id=<?php echo $pizza['id']; ?>" class="btn blue">Edit</a>
                    <form method="POST" style="display: inline;">
                    <input type="hidden" name="delete" value="<?php echo $pizza['id']; ?>"/>
                    <button type="submit" class="btn red">Delete</button>  
                    </form>
                </td>
            </tr>
            <?php endforeach ?>          
        </tbody>
    </table>
</div>
</body>
</section>
<?php include '../templates/dashboard.footer.php'; ?>
