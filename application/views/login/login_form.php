<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Signin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/css/font-awesome.min.css">
</head>
<body>
	<section>
		<div class="cont">
			<div id="form-cont-signin">
				<form method="POST" action="<?php echo base_url();?>user/login">
					<div id="form-head-signin">
						<div id="circle-signin">
							<div id="icon-head">
								<i class="icon-lock"></i>
							</div>
						</div>
						<h3>login panal</h3>
					</di>
					<div id="form-body-signin">
						<div id="ip-wrapper">
							<div id="icon-body-signin"><i class="icon-user"></i></div>
							<input type="text" name="u_email" placeholder="E-mail">
						</div>
						<div id="ip-wrapper">
							<div id="icon-body-signin"><i class="icon-lock"></i></div>
							<input type="password" name="u_password" placeholder="Password">
						</div>
						<div id="ip-wrapper" >
						<label><input type="checkbox" id="box">
						<span>Remember me</span></label>
						<span id="forgot-password"><a href="forgetpassword.html">Forgot Password?</a></span>
						</div>
						<div id="ip-wrapper">
						<button id="signin" name="signin">SIGN IN</button>
						</div>
						<div id="text">Don't have an account? <a href="<?php echo base_url();?>User/signup">Sign Up</a></div>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</section>
	
</body>
</html>