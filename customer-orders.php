<?php 
    include("components/header.php");
    include("components/header-1.php");
?>

<style>
    .table-my-orders th,
    .table-my-orders td {
        padding: 10px; /* Adjust as needed */
    }
</style>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Customer Dashboard
    </h2>
</section>

<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <?php include("components/customer-account-menu.php"); ?>

            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50" id="customer-order">
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
                                <td class="column-1">ORD - 21453</td>
                                <td class="column-2">13-02-2024</td>
                                <td class="column-3">Out Of Factory</td>
                                <td class="column-4">$ 36.00</td>
                            </tr>
                            <tr class="table_row">
                                <td class="column-1">ORD - 21453</td>
                                <td class="column-2">13-01-2024</td>
                                <td class="column-3">Out Of Factory</td>
                                <td class="column-4">$ 36.00</td>
                            </tr>
                            <tr class="table_row">
                                <td class="column-1">ORD - 21453</td>
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

<?php include("components/footer.php"); ?>
