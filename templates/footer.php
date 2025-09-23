<!--=============================================================
=  PAGE FOOTER
==============================================================-->
<footer class="page-footer grey lighten-3">
    <div class="container">

        <div class="row">

            <!-- Brand Info -->
            <div class="col s12 m6">
                <h5 class="brand-text">Nas Pizza</h5>
                <p class="grey-text text-darken-1">
                    Freshly baked pizzas delivered fast. Quality ingredients, great taste.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col s12 m4 offset-m2">
                <h5 class="orange-text text-darken-2">Links</h5>
                <ul>
                    <li><a class="footer-link" href="/pizza-hub/index.php">Home</a></li>
                    <li><a class="footer-link" href="/pizza-hub/menu.php">Menu</a></li>
                    <li><a class="footer-link" href="/pizza-hub/contact.php">Contact</a></li>
                    <li><a class="footer-link" href="/pizza-hub/Admin/dashboard.php">Dashboard</a></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="container center-align grey-text text-darken-1">
        &copy; <?php echo date('Y'); ?> Nas Pizza. All rights reserved.
    </div>
</footer>


<!--=============================================================
=  FOOTER STYLES
==============================================================-->
<style>
    .page-footer {
        padding-top: 20px;
        padding-bottom: 20px;
        border-top: 3px solid #f2d0a4;
    }

    .page-footer h5 {
        font-size: 1.4rem;
        margin-bottom: 10px;
    }

    .page-footer ul li {
        margin-bottom: 8px;
    }

    /* Updated link style */
    .footer-link {
        color: #616161; /* neutral grey */
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s, transform 0.3s;
    }

    .footer-link:hover {
        color: #cbb09c; /* brand color */
        transform: translateX(3px); /* subtle movement on hover */
        text-decoration: none;
    }

    .brand-text {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        font-size: 1.6rem;
    }
</style>

<!-- Closing body and html -->
</body>
</html>
