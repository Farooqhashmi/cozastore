<?php 
include("components/header.php")
?>

<head>
    <style>
        .signup-button {
            color: #ffffff; 
            background-color: #ff0000; 
            margin-top: 20px; 
        }
    </style>
</head>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Sign In
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-215 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="post"> 
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Welcome Back! Login or Sign up
						</h4>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="useremail" placeholder="Email">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>
                        <div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Password" placeholder="Password">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>
                        
						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Login
						</button>
						<h4 class="mtext-105 cl2 txt-center p-b-30">
    						<br> --- Don't have an account? ---
						</h4>
						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer signup-button">
						    Sign Up
						</button>
					</form>
				</div>				
					</div>
				</div>
			</div>
		</div>
	</section>	

<?php 
include("components/footer.php")
?>