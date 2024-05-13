<?php 
include('components/header.php'); 
?>

<head>
    <link rel="stylesheet" href="../cozastore/css/dashboard-style.css"> 
</head>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Your Dashboard
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <!-- Categories -->
            <div class="bg-img1 txt-center p-lr-15 p-tb-92">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Categories</h3>
                    <br><div class="category-buttons"></br>
                        <br><button class="category-btn">Dresses</button></br>
                        <br><button class="category-btn">Tops</button></br>
                        <br><button class="category-btn">Pants</button></br>
                        <br><button class="category-btn">Shoes</button></br>
                        <br><button class="category-btn">Accessories</button></br>
                    </div>
                </div>
            </div>
            <!-- Featured Products -->
            <div class="bg-img1 txt-center p-lr-15 p-tb-92">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Featured Products</h3>
                    <br><div class="featured-products-grid"></br>
                        <div class="product-item">Product 1</div>
                        <div class="product-item">Product 2</div>
                        <div class="product-item">Product 3</div>
                        <div class="product-item">Product 4</div> 
                        <div class="product-item">Product 5</div> 
                    </div>
                </div>
            </div>
            <!-- Sales Analytics -->
            <div class="bg-img1 txt-center p-lr-15 p-tb-92">
                <div class="dashboard-widget">
                    <h3 class="widget-title">Sales Analytics</h3>
                    <br><div class="sales-receipt"></br>
                        <p><strong>Total Sales:</strong> $10,000</p>
                        <p><strong>Number of Orders:</strong> 100</p>
                        <p><strong>Revenue per Order:</strong> $100</p>
                        <p><strong>Average Order Value:</strong> $100</p>
                        <p><strong>Top Selling Product:</strong> Product X</p>
                        <!-- Add more sales analytics data as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include('components/footer.php'); 
?>
