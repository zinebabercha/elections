<?php

	session_start();
	require_once("../model/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIGN UP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/js/register.js"></script>
	<link rel="stylesheet" href="assets/css/register.css">
</html>
<head>
<script src="assets/js/register.js"></script>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="home1" action="server.php" method="post">
				<div class="home__field ">
					<i class="home__icon fas fa-user"></i>
					<input type="text" class="home__input" placeholder="Username" name="username" required>
					
				</div>
                <div class="home__field ">
                    <i class="home__icon fas fa-envelope"></i>
					<input type="email" class="home__input" placeholder="Email" name="email" required>
				
				</div>
				<div class="home__field ">
					<i class="home__icon fas fa-lock"></i>
					<input type="password" class="home__input" placeholder="Password" id="pass" name="password" required>
		
				</div>
                <div class="home__field ">
                <i class="home__icon fas fa-lock"></i>
					<input type="password" class="home__input" placeholder="Confirm password" id="pass2" name="confirmPassword" required>
	
				</div>
				<button class="button home__submit" type="submit" name="signup">
					<span class="button__text" >Sign up Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>
				<br>
				<div class="foot-lnk">
					<a href="login.php" >Already a member?Login</a>
				</div>
			</form>
			<div class="social-home">
				<h3>Sign up via</h3>
				<div class="social-icons">
					<a href="#" class="social-home__icon fab fa-instagram"></a>
					<a href="#" class="social-home__icon fab fa-facebook"></a>
					<a href="#" class="social-home__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</head>
