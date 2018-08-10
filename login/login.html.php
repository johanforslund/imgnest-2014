<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Login</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
	
		<p style="text-align: center; color: #d53030;" class="stdtext"><?php htmlout($errors); ?></p>
		
		<div class="registerform">
		
				<form action="/login/index.php?login" method="post" name="loginform">   
					<input placeholder="USERNAME" class="registerinput" id="user_name" type="text" name="user_name" required /><br />

					<input placeholder="PASSWORD" class="registerinput" id="user_password" type="password" name="user_password" required /><br />

					<input class="registerbutton" type="submit" name="login" value="LOG IN" /><br />
				</form>
			
		</div>
		<p style="text-align: center; position: relative; top: 60px;" class="stdtext"><a style="text-decoration: underline;" href="/forgotpassword">Forgot password</a></p>			
		
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>