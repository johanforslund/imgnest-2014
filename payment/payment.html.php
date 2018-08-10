<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>
<?php include_once("config.php");?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Read More</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
<script src="js/jquery-latest.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/popup-style.css" />
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
		
		<form action="order_process.php" method="post">
            <input type="hidden" name="item_code" value="<?php htmlout($_GET['editedid']); ?>" />
			<input type="submit" id="submit" name="submit">
		</form>
		
	</div>
</div>

<div id="pop2" class="simplePopup">
	<div id="loader"><img src="images/ajax-loader.gif"/><img id="processing_animation" src="images/processing_animation.gif"/></div>
</div>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('input#submit').click(function() {
			$('#pop2').simplePopup();
		});
	});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>