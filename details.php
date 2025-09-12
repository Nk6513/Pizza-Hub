<?php

include"config/db_connect.php";

# Retreiving pizza by id

// Check Get request id parameter
if (isset($_GET["id"])) {

    // Escape sql chars
    $id = mysqli_real_escape_string($connection, $_GET["id"]);

    // Make Sql query
    $sql = "SELECT * FROM pizzas WHERE id= $id";

    // Get the query result
    $result = mysqli_query($connection, $sql);

    // Fetch result in Array format
    $pizzas = mysqli_fetch_assoc($result);

    // Release resources allocated for the query result
    mysqli_free_result($result);

    // Closing the database
    mysqli_close($connection);

}


# Deleting a pizza 

if (isset($_POST["delete_id"])) {

    // Deleting record by id
    $delete_id = mysqli_real_escape_string($connection, $_POST['delete_id']);

    // Running Delete query

    $sql = "DELETE FROM pizzas WHERE id= $delete_id";

    // Storing data in result variable
    if(mysqli_query($connection, $sql))  {
    // Success
    header("Location: index.php");
    }
   else {
    // Failure
    echo "Query error: " . mysqli_error($connection);
    } 

}

?>


<?php include 'templates/header.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
</head>

<body>
<div class="container center grey-text">
    <?php if($pizzas) :  ?>
        <h4><?php echo $pizzas['title']; ?></h4>
        <p> Created by <?php echo $pizzas['email']; ?></p>
        <p><?php echo date($pizzas['created_at']) ?></p>
        <h5>Ingredients: </h5>
        <p><?php echo $pizzas['ingredients']; ?></p>
        <?php else: ?>
            <h5>No such pizza exists.</h5>
        <?php  endif; ?>

        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="delete_id" value="<?php echo $pizzas['id']; ?>" >
            <input type="submit" name="delete" value="DELETE" class="btn brand z-depth-0">
        </form>
</div>
</body>




<?php include 'templates/footer.php'; ?>

</html>