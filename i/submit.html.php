<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Submit Edited Image</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
		<form action="?submitsent" enctype="multipart/form-data" method="post">
			<div class="form">
				
				<div class="leftofform">
					<div class="dropbox">
						<div id="img_prev" class="drop">
							<input onchange="readURL(this);" accept="image/*" type="file" name="image" />
						</div>
					</div>
					<p style="position:relative; left: -5px; float:right; margin-top: 5px;" class="stdtext">Max file size: <strong>8mb</strong> | Supported formats: <strong>jpeg, png, gif</strong></p>
				</div>
				
				<div class="rightofform">
					<textarea placeholder="Message (optional)" class="submitmessage" type="text" name="message"><?php htmlout($message);?></textarea>
					<input type="hidden" name="submittedimage" value="<?php htmlout($_GET['submit'])?>" />
					<input type="submit" value="Submit" class="submitbutton" style="top: 10px;"/>
					<p style="text-align: center; color: #d53030; top: 35px;" class="stdtext"><?php htmlout($error); ?></p>
				</div>
				
				<div class="clear"></div>
				
			</div>
		</form>
	</div>
	
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>