<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Read More</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
		
		<div class="dottedmiddle"></div>
		<div class="lefttext">
			<h1 class="stdheader" style="font-size: 58px; margin-bottom: 40px;">Do you need a photo edited?</h1>
			<div class="clear"></div>
			<img alt ="Upload an image that you want edited" src="/images/readmoreleft1.png" class="readmoreleft1" />
			<img alt=" Wait for other users to edit your image" src="/images/readmoreleft2.png" class="readmoreleft2" />
			<img alt="Download the finished and edited result" src="/images/readmoreleft3.png" class="readmoreleft3" />
		</div>
		<div class="righttext">
			<h1 class="stdheader" style="font-size: 58px; float: right; margin-bottom: 40px;">Looking for photos to edit?</h1>
			<div class="clear"></div>
			<img alt ="Find an image that suits your skills" src="/images/readmoreright1.png" class="readmoreright1" />
			<img alt="Edit the image as the uploader requests" src="/images/readmoreright2.png" class="readmoreright2" />
			<img alt="Upload the finished and edited result" src="/images/readmoreright3.png" class="readmoreright3" />
		</div>
		<div class="clear"></div>
			
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>