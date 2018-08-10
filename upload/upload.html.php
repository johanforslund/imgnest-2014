<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Upload Image That You Need Edited</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
			
			<form action="?upload" enctype="multipart/form-data" method="post">
			
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
						<input type="text" placeholder="Title" class="formtitle" name="title" maxlength="24" value="<?php htmlout($title);?>" required />
						<textarea placeholder="Description" class="formdesc" type="text" name="description"><?php htmlout($description);?></textarea>
						<select name="formcat" class="formcat" required>
							<option value="" selected disabled>Category</option>
							<option value="Colorize">Colorize</option>
							<option value="Effects">Effects</option>
							<option value="Logos">Logos</option>
							<option value="Remove">Remove</option>
							<option value="Restore">Restore</option>
							<option value="Retouch">Retouch</option>
							<option value="Other">Other</option>
						</select>
						
						<p style="font-weight: bold;" class="amounttext">I am willing to pay</p>
						<input type="text" placeholder="0" class="formamount" name="amount" />
						<p style="font-weight: bold;" class="amounttext">$.</p>
						<input type="submit" value="Submit" class="submitbutton" />
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