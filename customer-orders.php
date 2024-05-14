<?php include ("components/header.php"); ?>
<?php include ("components/header-1.php"); ?>	


    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Customer Dashboard
        </h2>
    </section>
    <section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">

                <?php
                    include ("components/customer-account-menu.php");
                ?>

                <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50 " id="customer-order">
                    <!-- <div class="box">
                        <h1>Order #1735</h1>

                        <p class="lead">Order #1735 was placed on <strong>22/06/2013</strong> and is currently <strong>Being prepared</strong>.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="img/detailsquare.jpg" alt="White Blouse Armani">
                                            </a>
                                        </td>
                                        <td><a href="#">White Blouse Armani</a>
                                        </td>
                                        <td>2</td>
                                        <td>$123.00</td>
                                        <td>$0.00</td>
                                        <td>$246.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="img/basketsquare.jpg" alt="Black Blouse Armani">
                                            </a>
                                        </td>
                                        <td><a href="#">Black Blouse Armani</a>
                                        </td>
                                        <td>1</td>
                                        <td>$200.00</td>
                                        <td>$0.00</td>
                                        <td>$200.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Order subtotal</th>
                                        <th>$446.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Shipping and handling</th>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Tax</th>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Total</th>
                                        <th>$456.00</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                        <div class="row addresses">
                            <div class="col-md-6">
                                <h2>Invoice address</h2>
                                <p>John Brown
                                    <br>13/25 New Avenue
                                    <br>New Heaven
                                    <br>45Y 73J
                                    <br>England
                                    <br>Great Britain</p>
                            </div>
                            <div class="col-md-6">
                                <h2>Shipping address</h2>
                                <p>John Brown
                                    <br>13/25 New Avenue
                                    <br>New Heaven
                                    <br>45Y 73J
                                    <br>England
                                    <br>Great Britain</p>
                            </div>
                        </div>

                    </div> -->
                    <div class="wrap-recent-orders bor10 p-lr-20 p-t-20 p-b-20">
                        <h2>All Orders</h2> 
                        <div class="wrap-table-my-orders m-t-20">
                            
                            <table class="table-my-orders">
                                <tr class="table_head">
                                    <th class="column-1">Order #</th>
                                    <th class="column-2">Order Date</th>
                                    <th class="column-3">Order Status</th>
                                    <th class="column-4">Total</th>
                                </tr>

                                <tr class="table_row">
                                    <td class="column-1">
                                        ORD - 21453
                                    </td>
                                    <td class="column-2">13-02-2024</td>
                                    <td class="column-3">Out Of Factory</td>
                                    <td class="column-4">$ 36.00</td>
                                </tr>
                                <tr class="table_row">
                                    <td class="column-1">
                                        ORD - 21453
                                    </td>
                                    <td class="column-2">13-01-2024</td>
                                    <td class="column-3">Out Of Factory</td>
                                    <td class="column-4">$ 36.00</td>
                                </tr>
                                <tr class="table_row">
                                    <td class="column-1">
                                        ORD - 21453
                                    </td>
                                    <td class="column-2">13-05-2024</td>
                                    <td class="column-3">Out Of Factory</td>
                                    <td class="column-4">$ 36.00</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </section>

<?php
	include ("components/footer.php");
?>