<?php 

//===============================================================
// PAYMENT PAGE
//===============================================================


//---------------------------------------------------------------
// Start Session & DB Connection
//---------------------------------------------------------------
session_start();
include('../config/db_connect.php');


//---------------------------------------------------------------
// Get Pizza ID from URL (if provided)
//---------------------------------------------------------------
$pizza_id = isset($_GET['pizza_id']) ? (int) $_GET['pizza_id'] : 0;


//---------------------------------------------------------------
// Handle Form Submission
//---------------------------------------------------------------
if (isset($_POST['submit'])) {

    // Initialize variables
    $customer_name = $email = $address = $amount = $payment_method = '';
    $errors = [
        'customer_name' => '',
        'email'         => '',
        'address'       => '',
        'amount'        => ''
    ];


    // Validate Customer Name
    if (empty($_POST['customer_name'])) {
        $errors['customer_name'] = 'Name is required';
    } else {
        $customer_name = trim($_POST['customer_name']);
        if (!preg_match('/^[a-zA-Z\s]+$/', $customer_name)) {
            $errors['customer_name'] = 'Name must be letters and spaces only';
        }
    }

    // Validate Email
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required";
    } else {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be in valid format";
        }
    }

    // Validate Address
    if (empty($_POST['address'])) {
        $errors['address'] = "Address is required";
    } else {
        $address = trim($_POST['address']);
    }

    // Validate Amount
    if (empty($_POST['amount']) || $_POST['amount'] <= 0) {
        $errors['amount'] = "Enter a valid amount";
    } else {
        $amount = floatval($_POST['amount']);
    }

    // Payment Method
    $payment_method = $_POST['payment_method'] ?? 'credit_card';

    // If no validation errors → Insert into DB
    if (!array_filter($errors)) {

        // Sanitize inputs
        $customer_name  = mysqli_real_escape_string($conn, $customer_name);
        $email          = mysqli_real_escape_string($conn, $email);
        $address        = mysqli_real_escape_string($conn, $address);
        $amount         = mysqli_real_escape_string($conn, $amount);
        $payment_method = mysqli_real_escape_string($conn, $payment_method);

        // Get Pizza ID from hidden input if available
        if (isset($_POST['pizza_id'])) {
            $pizza_id = (int) $_POST['pizza_id'];
        }

        // Insert order into database
        $sql = "INSERT INTO orders (pizza_id, customer_name, email, address, amount, payment_method, created_at)
                VALUES ($pizza_id, '$customer_name', '$email', '$address', '$amount', '$payment_method', NOW())";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = 'Payment simulated successfully! Order recorded.';
            header('Location: ./success.php');
            exit;
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    }
}

?>


<?php include '../templates/header.php'; ?>

<!--=============================================================
=  PAYMENT FORM
==============================================================-->
<section>
  <div class="container">
    
    <!-- Page Title -->
    <h4 class="center-align">Payment Details</h4>

    <!-- Success / Error Message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="payment-notify orange-text center-align">
            <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Payment Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="white z-depth-2">

        <!-- Hidden Pizza ID -->
        <input type="hidden" name="pizza_id" value="<?php echo $pizza_id; ?>"/>

        <div class="row">

            <!-- Customer Name -->
            <div class="input-field col s6">
                <input type="text" name="customer_name" placeholder="Name" required>
            </div>

            <!-- Email -->
            <div class="input-field col s6">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <!-- Address -->
            <div class="input-field col s6">
                <input type="text" name="address" placeholder="Billing Address" required>
            </div>

            <!-- Amount -->
            <div class="input-field col s6">
                <input type="number" name="amount" placeholder="Amount ($)" required>
            </div>

            <!-- Payment Methods -->
            <div class="col s12">
                <p>Payment Method</p>
                <label>
                    <input name="payment_method" type="radio" value="credit_card" checked />
                    <span>Credit Card</span>
                </label>
                <label>
                    <input name="payment_method" type="radio" value="debit_card" />
                    <span>Debit Card</span>
                </label>
                <label>
                    <input name="payment_method" type="radio" value="paypal" />
                    <span>PayPal</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="center-align col s12" style="margin-top: 30px;">
                <button type="submit" name="submit" class="btn btn-brand">Pay Now</button>
            </div>
        </div>
    </form>
  </div>
</section>


<?php include '../templates/footer.php'; ?>


<!--=============================================================
=  AUTO-HIDE MESSAGE
==============================================================-->
<?php if (isset($_SESSION['message'])): ?>
<script> 
    setTimeout(() => {
        const message = document.querySelector('.card-panel');
        if (message) {
            message.style.display = 'none';
        }
    }, 4000);
</script>
<?php endif; ?>


<!--=============================================================
=  CUSTOM STYLES
==============================================================-->
<style>
    body { background-color: #f5f5f5; }
    h4 { margin-bottom: 30px; color: #cbb09c; }
    .btn-brand { background-color: #cbb09c; }
    .input-field input:focus { 
        border-bottom: 1px solid #cbb09c !important; 
        box-shadow: 0 1px 0 0 #cbb09c !important; 
    }
</style>
