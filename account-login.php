<?php
	include ("components/header.php");
	if(isset($_SESSION['sessionemail'])){
		echo "<script>
            location.assign('my-account.php');
            </script>";
	}
?> 

<?php include ("components/header-1.php"); ?>


	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Customer Dashboard
		</h2>
	</section>	

	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="post">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
						Customer Registration
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="text" name="username" placeholder="Full Name">
							<img class="how-pos4 pointer-none" src="images/icons/user.png" width="25px" alt="ICON">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="text" name="useremail" placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="images/icons/email.png" width="23px" alt="ICON">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="tel" name="userphone" placeholder="Contact Number">
							<img class="how-pos4 pointer-none" src="images/icons/phone.png"  width="20px"  alt="ICON">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="password" name="userpassword" placeholder="Password">
							<img class="how-pos4 pointer-none" src="images/icons/password.png"  width="20px"  alt="ICON">
						</div>

						<button type="submit" name="userregister" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Register
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<form  method="post">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
						Customer Login
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="customeremail" required placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="images/icons/email.png" width="23px" alt="ICON">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="customerpassword" required placeholder="Password">
							<img class="how-pos4 pointer-none" src="images/icons/password.png"  width="20px"  alt="ICON">
						</div>

						<button type="submit" name="userlogin" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Login
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>	

<?php
	include ("components/footer.php");
?>	
