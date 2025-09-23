<!--=============================================================
=  SUCCESS MESSAGE
==============================================================-->
<?php include '../templates/header.php'; ?>

<section>
    <div class="container success-wrapper">
        <div class="card success-card z-depth-2">

            <!-- Success Icon -->
            <div class="success-icon">
                <i class="material-icons">check_circle</i>
            </div>

            <!-- Title -->
            <h4>Thank You!</h4>

            <!-- Message -->
            <p class="flow-text">
                Your payment has been received successfully.
            </p>
            <p class="grey-text">
                We’re preparing your order. You’ll get an update shortly.
            </p>

            <br>

            <!-- Back to Home -->
            <a href="/pizza-hub/index.php" class="btn brand z-depth-0">
                Back to Home
            </a>
        </div>
    </div>
</section>

<?php include '../templates/footer.php'; ?>


<!--=============================================================
=  CUSTOM STYLES
==============================================================-->
<style>
    .success-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .success-card {
        max-width: 500px;
        width: 100%;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
    }

    .success-icon {
        font-size: 70px;
        color: #4caf50;
        margin-bottom: 20px;
    }
</style>
