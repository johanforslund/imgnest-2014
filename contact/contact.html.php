<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Contact Us</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
	
		<h1 style="text-align: center; text-decoration: underline; margin-bottom: 30px;" class="stdheader">Contact</h1>
			
		<form action="?sent" method="post" style="text-align: center;">
			<input type="text" placeholder="Name" class="formtitle" name="name" style="margin-bottom: 10px;" required autofocus><br />
			<input type="email" placeholder="Email" class="formtitle" name="email" required><br />
			<textarea placeholder="Message" class="formdesc" type="text" name="message" required></textarea><br />
			<input style="left: 0;" type="submit" name="submit" value="Submit" class="submitbutton" />
		</form>
			
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>