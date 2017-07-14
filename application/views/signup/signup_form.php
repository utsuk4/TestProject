<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register - Signup</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/css/font-awesome.min.css">
</head>
<body>
	<section>
		<div class="cont">
			<div id="form-cont">
				<form method="POST" action="<?php echo base_url();?>user/signup">
					<div id="form-head">
						<div id="circle">
							<div id="icon-head">
								<i class="icon-book"></i>
							</div>
						</div>
						<h3>REGISTER</h3>
					</div>
					<div id="head-tail">
						<img src="images/point.png" width="15px" height="10px">
					</div>
					<div id="form-body">
						<div id="ip-wrapper">
						<div id="icon-body">
						<i class="icon-user"></i></div>
						<input type="text" name="u_name" placeholder="Username">
						</div>
						<div id="ip-wrapper">
						<div id="icon-body">
						<i class="icon-lock"></i></div>
						<input type="password" name="u_password" placeholder="Password">
						</div>
			
						<div id="ip-wrapper">
						<div id="icon-body">
						<i class="icon-envelope-o"></i></div>
						<input type="email" name="u_email" placeholder="E-mail">
						</div>
                                            
                                                <div id="ip-wrapper">
						<div id="icon-body">
						<i class="icon-user"></i></div>
						<input type="text" name="u_contact" placeholder="Phone Number">
						</div>

						<div id="ip-wrapper" >
						<label><input type="checkbox" id="box">
						<span>I agree to the <span id="p11"> Term of Service
						</span></span></label>
						</div>

						<!-- <div id="ip-wrapper">
						<div id="check">
						<input type="checkbox" name="email" placeholder="E-mail">
						<div>
						</div>
						<div></div> -->
						<div id="ip-wrapper">
						<button id="signup">SIGN UP</button>
						</div>
						<div id="ip-wrapper">
						<div id="text">
							Already a member? <a href="<?php echo base_url();?>User/login">Login Here</a>
							</div>
						</div>
				</form>
			</div>
		</div>
	</section>	
</body>
</html>