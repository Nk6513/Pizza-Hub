<?php 

//===============================================================
// ADMIN LOGIN
//===============================================================


//---------------------------------------------------------------
// Start session and connect to database
//---------------------------------------------------------------
session_start();
include('../config/db_connect.php');


//---------------------------------------------------------------
// Initialize variables
//---------------------------------------------------------------
$error = '';


//---------------------------------------------------------------
// Handle Login Form Submission
//---------------------------------------------------------------
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ✅ Hardcoded credentials (for demo only)
    if ($username === 'testadmin' && $password === 'pass123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username']  = $username;

        header('Location: ../Admin/dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

?>  


<?php include '../templates/header.php'; ?>


<!--=============================================================
=  LOGIN FORM
==============================================================-->
<section class="container login-wrapper">
    <div class="card login-card z-depth-2">

        <h5 class="center-align">Admin Login</h5>

        <!-- Error Message -->
        <?php if ($error): ?>
            <p class="red-text center-align">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="input-field">
                <input id="username" type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-field">
                <input id="password" type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="login" class="btn brand z-depth-0">Login</button>
        </form>

    </div>
</section>


<?php include '../templates/footer.php'; ?>


<!--=============================================================
=  PAGE STYLES
==============================================================-->
<style>
    body {
        height: 100vh;
        margin: 0;
        background: #f4f4f4;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .login-card {
        padding: 30px;
        max-width: 400px;
        width: 100%;
    }
</style>
