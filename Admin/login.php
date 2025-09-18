<?php
session_start();
include('../config/db_connect.php');

$error = '';

if(isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if($username == 'testadmin' &&  $password == "pass123") {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../Admin/dashboard.php');
        exit;
    }
    else {
        $error = "invalid username or password";
        }
}

?>  

<?php include '../templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> 
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
</head>
<body>
    <section class="container login-wrapper">
    <div class="card login-card z-depth-2">
        <h5 class="center-align">Admin Login</h5>
        <?php if($error): ?>
            <p class="red-text center-align"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
</body>
</html>

