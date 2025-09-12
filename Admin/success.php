<?php include '../templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Success</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> 
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
</head>
<body>

  <div class="container success-wrapper">
    <div class="card success-card z-depth-2">
      <h4>Thank You!</h4>
      <p class="flow-text">Your payment has been received successfully.</p>
      <p class="grey-text">We’re preparing your order. You’ll get an update shortly.</p>
      <br>
      <a href="/pizza-hub/index.php" class="btn brand z-depth-0">Back to Home</a>
    </div>
  </div>

  <?php include '../templates/footer.php'; ?>

</body>
</html>
