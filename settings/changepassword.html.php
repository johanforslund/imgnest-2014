<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Change Password</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
		<div class="settingswrap">
			<div class="settingsbar">
				<div class="settingholder"><a href="?general" class="settingslink">General</a></div>
				<div class="settingholder"><a href="?changeemail" class="settingslink">Change email</a></div>
				<div style="border-right: none;" class="settingholder"><a href="?changepassword" class="settingslink">Change password</a></div>
			</div>
			
			<form action="?changepassword&save=password" method="post" name="user_edit_form_name">
				<label for="user_password_old" class="settingslabel">Old password:</label><br />
				<input id="user_password_old" name="user_password_old" type="password" /><br />
				
				<label for="user_password_new" class="settingslabel">New password:</label><br />
				<input id="user_password_new" name="user_password_new" type="password" /><br />
				
				<label for="user_password_repeat" class="settingslabel">Repeat new password:</label><br />
				<input id="user_password_repeat" name="user_password_repeat" type="password" /><br />
				
				<input name="user_edit_submit_password" type="submit" style="left: 0" class="submitbutton" value="Save"/><br />
			</form>
			<?php if(isset($_GET['success'])): ?><i style="position: relative; top:45px;" class="fa fa-check"></i> <p style="position: relative; top: 45px; display: inline-block;" class="stdtext">Password has been updated</p>
			<?php elseif(isset($_GET['save'])):?><p style="position: relative; top: 45px; display: inline-block;" class="stdtext"><?php htmlout($message); ?></p><?php endif; ?>
		</div>	
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>