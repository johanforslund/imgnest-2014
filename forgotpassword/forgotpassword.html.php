<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Forgot Password</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
	
		<?php
		if ($login->passwordResetLinkIsValid() == true) {
		?>             
		<form style="text-align: center;" method="post" action="password_reset1.php" name="new_password_form">
			<input type='hidden' name='user_name' value='<?php htmlout($_GET['user_name']); ?>' />
			<input type='hidden' name='user_password_reset_hash' value='<?php htmlout($_GET['verification_code']); ?>' />

			<label style="font-family: 'Pathway Gothic One'; font-size: 17px;" for="user_password_new">New password</label>
			<input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

			<label style="font-family: 'Pathway Gothic One'; font-size: 17px;" for="user_password_repeat">Repeat new password</label>
			<input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
			<input type="submit" name="submit_new_password" value="Submit new password" />
		</form>
		<?php
		} else {
		?>
		<p style="text-align: center; color: #77988d;" class="stdtext"><?php htmlout($messages); ?></p>
		<p style="text-align: center; color: red;" class="stdtext"><?php htmlout($errors); ?></p>
		<form style="text-align: center;" method="post" action="?sent" name="password_reset_form">
			<label class="stdtext" for="user_name">Enter your username and you'll get a mail with instructions:</label>
			<input id="user_name" type="text" name="user_name" required />
			<input type="submit" name="request_password_reset" value="Reset my password" />
		</form>
		<?php
		}
		?>
			
		
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>