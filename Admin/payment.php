<?php
// Redirect to success page on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: success.php");
    exit;
}
?>

<?php include '../templates/header.php'; ?>

<style>
    body {
        background-color: #f5f5f5;
    }

    h4 {
        margin-bottom: 30px;
        color: #cbb09c;
    }

    .btn-brand {
        background-color: #cbb09c;
    }

    input:focus + label {
        color: #cbb09c !important;
    }

    .input-field input:focus {
        border-bottom: 1px solid #cbb09c !important;
        box-shadow: 0 1px 0 0 #cbb09c !important;
    }
</style>

<section>
    <div class="container">
        <h4 class="center-align">Payment Details</h4>

        <form action="#" method="POST">
            <!-- Name on Card -->
            <div class="input-field">
                <input type="text" id="card_name" name="card_name" placeholder="Name on Card" required>
            </div>

            <!-- Card Number -->
            <div class="input-field">
                <input type="text" id="card_number" name="card_number" maxlength="16" placeholder="Card Number" required>
            </div>

            <!-- Expiry Date -->
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" id="expiry_month" name="expiry_month" maxlength="2" placeholder="Expiry Month (MM)" required>
                </div>
                <div class="input-field col s6">
                    <input type="text" id="expiry_year" name="expiry_year" maxlength="4" placeholder="Expiry Year (YYYY)" required>
                </div>
            </div>

            <!-- CVV -->
            <div class="input-field">
                <input type="password" id="cvv" name="cvv" maxlength="4" placeholder="CVV" required>
            </div>

            <!-- Amount -->
            <div class="input-field">
                <input type="number" id="amount" name="amount" placeholder="Amount ($)" required>
            </div>

            <!-- Payment Method -->
            <p>Payment Method</p>
            <p>
                <label>
                    <input name="payment_method" type="radio" value="credit_card" checked />
                    <span>Credit Card</span>
                </label>
            </p>
            <p>
                <label>
                    <input name="payment_method" type="radio" value="debit_card" />
                    <span>Debit Card</span>
                </label>
            </p>
            <p>
                <label>
                    <input name="payment_method" type="radio" value="paypal" />
                    <span>PayPal</span>
                </label>
            </p>

            <!-- Submit Button -->
            <div class="center-align" style="margin-top: 30px;">
                <button type="submit" class="btn btn-brand">Pay Now</button>
            </div>
        </form>
    </div>
</section>

<?php include '../templates/footer.php'; ?>
