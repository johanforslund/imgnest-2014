<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Change Settings</title>
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
			
			<p class="settingslabel">Recieve newsletter:</p>
			
			<form action="?save=newsletter" method="post">
				<input type="radio" name="newsletter" id="yes" value="Yes" <?php htmlout($yes); ?>>
				<label style="font-family: 'Pathway Gothic One'; font-size: 20px;" for="yes">Yes</label>
				<input type="radio" name="newsletter" id="no" value="No" <?php htmlout($no); ?>>
				<label style="font-family: 'Pathway Gothic One'; font-size: 20px;" for="no">No</label><br />
				<input type="submit" style="left: 0" class="submitbutton" value="Save"/><br />
			</form>
			<?php if(isset($_GET['success'])): ?><i style="position: relative; top:45px;" class="fa fa-check"></i> <p style="position: relative; top: 45px; display: inline-block;" class="stdtext">Updates have been made</p><?php endif; ?>
		</div>	
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>