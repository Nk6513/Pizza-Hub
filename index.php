<?php
//---------------------------------------------------------------
// INDEX PAGE
//---------------------------------------------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php include './templates/header.php'; ?>

<!-- Simple color & font setup -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .shine-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.3);
        transform: skewX(-25deg);
    }

    .shine-btn:hover::after {
        left: 125%;
        transition: left 0.7s ease;
    }

    /* Align hero text to the left */
    .hero-content {
        text-align: center;
        padding-left: 50px;
    }

    @media (max-width: 600px) {
        .hero-content {
            padding-left: 20px;
        }
    }
</style>

<!-- Hero Section -->
<div class="section valign-wrapper"
    style="background: url('img/PizzaHeroImage.jpeg') center/cover no-repeat; height: 85vh; border-top: 3px solid #f2d0a4;">
    <div class="container">
        <h2 class="white-text text-lighten-4">Welcome to <span class="brand-text">Nas Pizza</span></h2>
        <h5 class="white-text text-lighten-3">Delicious. Fresh. Authentic.</h5>
        <a href="menu.php"
            class="btn-large waves-effect waves-light brand z-depth-2 hoverable shine-btn"
            style="margin-top: 20px; position: relative; overflow: hidden;">
            Explore Menu
        </a>
    </div>
</div>

<!-- About Section -->
<div class="section white">
    <div class="container">
        <h4 class="center grey-text text-darken-3">Our Story</h4>
        <p class="center grey-text text-darken-1">
            At <strong>Nas Pizza</strong>, we craft every pizza with passion and precision.
            From hand-stretched dough to the finest locally-sourced ingredients,
            our goal is to bring you the perfect bite every time.
        </p>
    </div>
</div>

<!-- Highlight Section -->
<div class="section brand white-text center">
    <div class="container">
        <h5>“The taste of tradition — made with love, served with warmth.”</h5>
    </div>
</div>

<!-- Call to Action -->
<div class="section center white">
    <div class="container">
        <h5 class="grey-text text-darken-2">Hungry? Let’s fix that!</h5>
        <a href="menu.php" class="btn-large brand waves-effect waves-light z-depth-1 shine-btn" style="margin-top: 10px;">
            Order Now
        </a>
    </div>
</div>

<?php include 'templates/footer.php'; ?>