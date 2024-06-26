<?php
session_start(); 
include ("components/header.php"); 
include("../cozastore/php/dbcon.php"); 
?>

<style>
    .table-my-orders th,
    .table-my-orders td {
        padding: 10px; 
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
            <!-- Sidebar Account Menu -->
            <?php include ("components/customer-account-menu.php"); ?>
            <!-- Account Page Content -->
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50 ">
                <div class="wrap-recent-orders bor10 p-lr-20 p-t-20 p-b-20">
                    <h2>Recent Orders</h2> 
                    <div class="wrap-table-my-orders m-t-20">
                        <table class="table-my-orders">
                            <tr class="table_head">
                                <th class="column-1">Order #</th>
                                <th class="column-2">Order Date</th>
                                <th class="column-3">Order Status</th>
                                <th class="column-4">Total</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box bor10 account-details-wrapper m-t-40 p-lr-20 p-t-20 p-b-20">
                    <h3>Personal details</h3>
                    <form method="post" action="update-details.php"> 
                        <input type="hidden" value="<?php echo isset($_SESSION['sessionid']) ? htmlspecialchars($_SESSION['sessionid']) : ''; ?>" name="userid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="username">Full Name</label>
                                    <input type="text" class="form-control" id="username" value="<?php echo isset($_SESSION['sessionname']) ? htmlspecialchars($_SESSION['sessionname']) : ''; ?>" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" id="phone" value="<?php echo isset($_SESSION['sessionphone']) ? htmlspecialchars($_SESSION['sessionphone']) : ''; ?>" name="userphone">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo isset($_SESSION['sessionemail']) ? htmlspecialchars($_SESSION['sessionemail']) : ''; ?>" name="useremail">
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary" name="updatedetails"><i class="fa fa-save"></i> Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ("components/footer.php"); ?>
