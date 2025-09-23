<?php 
//===============================================================
// ADD / EDIT PIZZA
//===============================================================

// Start session and check login
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Connect to Database
include('../config/db_connect.php');

// Initialize variables
$email = $title = $ingredients = $price = "";
$errors = [
    'email'       => '',
    'title'       => '',
    'ingredients' => '',
    'price'       => ''
];

// Handle form submission (Add / Update Pizza)
if (isset($_POST['submit'])) {
    // Validate Email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // Validate Title
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must contain only letters and spaces';
        }
    }

    // Validate Ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingredient is required';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be a comma separated list';
        }
    }

    // Validate Price
    if (empty($_POST['price'])) {
        $errors['price'] = 'Price has to be set';
    } else {
        $price = floatval($_POST['price']);
        if (!is_numeric($price) || $price <= 0) {
            $errors['price'] = 'Price must be a positive number or decimal';
        }
    }

    // If no errors, process database query
    if (!array_filter($errors)) {
        // Escape data safely
        $email       = mysqli_real_escape_string($conn, $_POST['email']);
        $title       = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        $price       = mysqli_real_escape_string($conn, $_POST['price']);

        // Update existing pizza
        if (!empty($_POST['update_id'])) {
            $id  = (int)$_POST['update_id'];
            $sql = "
                UPDATE pizzas 
                SET email       = '$email', 
                    title       = '$title', 
                    ingredients = '$ingredients', 
                    price       = $price 
                WHERE id = $id
            ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: add.php");
                exit();
            }

        // Insert new pizza
        } else {
            $sql = "
                INSERT INTO pizzas (email, title, ingredients, price, created_at) 
                VALUES ('$email', '$title', '$ingredients', '$price', NOW())
            ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['message'] = "Pizza added successfully";
            } else {
                echo 'Query error: ' . mysqli_error($conn);
            }
        }
    }
}

// Retrieve pizza details for edit
$pizza = [
    'email'       => '',
    'title'       => '',
    'ingredients' => '',
    'price'       => ''
];

if (isset($_GET['edit_id'])) {
    $id     = (int)$_GET['edit_id'];
    $sql    = "SELECT * FROM pizzas WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $pizza = mysqli_fetch_assoc($result);
    }
    mysqli_free_result($result);
}

?>

<?php include("../templates/dashboard_header.php"); ?>

<section class="container grey-text">

    <h4 class="center teal-text text-darken-2">
        <?php echo isset($_GET['edit_id']) ? 'Edit Pizza' : 'Add a Pizza'; ?>
    </h4>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-panel orange-text" style="text-align:center;">
            <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
        </div>

        <script>
        // Auto-hide flash message after 4 seconds
        const message = document.querySelector('.card-panel');
        if (message) {
            setTimeout(() => {
                message.style.transition = "opacity 0.5s ease";
                message.style.opacity = "0";
                setTimeout(() => { message.remove(); }, 500);
            }, 4000);
        }
        </script>

        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if ($pizza): ?>
        <form class="white z-depth-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <!-- Email -->
            <label>Your Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($pizza['email']); ?>">
            <div class="red-text"><?php echo $errors['email'] ?? ''; ?></div>

            <!-- Pizza Title -->
            <label>Pizza Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($pizza['title']); ?>">
            <div class="red-text"><?php echo $errors['title'] ?? ''; ?></div>

            <!-- Ingredients -->
            <label>Ingredients (comma separated)</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($pizza['ingredients']); ?>">
            <div class="red-text"><?php echo $errors['ingredients'] ?? ''; ?></div>

            <!-- Price -->
            <label>Price</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($pizza['price']); ?>">
            <div class="red-text"><?php echo $errors['price'] ?? ''; ?></div>

            <!-- Hidden ID for Update -->
            <?php if (!empty($pizza['id'])): ?>
                <input type="hidden" name="update_id" value="<?php echo htmlspecialchars($pizza['id']); ?>">
            <?php endif; ?>

            <!-- Submit Button -->
            <div class="center">
                <input type="submit" name="submit" value="<?php echo isset($_GET['edit_id']) ? 'Update' : 'Submit'; ?>" class="btn teal z-depth-0">
            </div>

        </form>
    <?php endif; ?>

</section>

<?php include("../templates/dashboard.footer.php"); ?>
