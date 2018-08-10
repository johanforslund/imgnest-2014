<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Sign Up</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
	
	<div class="lefttext">
		<h1 style="position: relative; top: -10px;" class="stdheader">Sign up now</h1>
		<p style="font-size: 19px;" class="stdtext"><strong>Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.</strong></p>
		<hr />
		<p class="stdtext">Register now to be a part of our growing community and take advantage of our features.</p><br />
		<p class="stdtext">100% free.</p>
		<p class="stdtext">Easy to use.</p><br />
		<p class="stdtext"><strong>Welcome to the nest.</strong></p><br />
		<p class="stdtext"><a style="text-decoration: underline;" href="/readmore"><em>Read more here.</em></a></p>
	</div>
	<div class="righttext">
		<p class="signuperror"><?php htmlout($signuperror); ?></p>
		<div class="registerform">
		
				<form method="post" action="" name="registerform">   
					<input placeholder="USERNAME" class="registerinput" id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" value="<?php htmlout($username); ?>" required /><br />

					<input placeholder="EMAIL" class="registerinput" id="user_email" type="email" name="user_email" value="<?php htmlout($email); ?>" required /><br />

					<input placeholder="PASSWORD" class="registerinput" id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /><br />

					<input placeholder="CONFIRM PASSWORD" class="registerinput" id="user_password_repeat" type="password" name="user_password_repeat" style="margin-bottom: 10px;" pattern=".{6,}" required autocomplete="off" /><br />        

					<img src="/includes/login/tools/showCaptcha.php" alt="captcha" style="border: 1px solid #cdced0; width: 415px; height: 100px;" /><br />

					<input placeholder="ENTER THE LETTERS FROM ABOVE" class="registerinput" type="text" name="captcha" required autocomplete="off" /><br />

					<input class="registerbutton" type="submit" name="register" value="SIGN UP" /><br />
				</form>
			
		</div>
	</div>
	
	<div class="clear"></div>
		
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>