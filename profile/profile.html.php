<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - <?php htmlout($_GET['profileid']); ?></title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">	
			
		<i class="fa fa-user bigusericon"></i>
		<h1 style="display: inline-block;" class="stdheader"><?php htmlout($_GET['profileid']); ?></h1>
		<span title="Total amount of recieved likes"><p class="profilelikes"><i style="position: relative; top: -5px; font-size: 25px;" class="fa fa-star"></i> <?php htmlout($myLikes); ?></p></span>
		<p class="memberfor">(Member for <?php htmlout($dayssince);?> days)</p>
		<hr />
		
		<h2 class="profilecaption">Edited images:</h2>
		
		<div class="imagescontainer">
		<?php if(isset($images)): foreach($images as $image): ?>
			<a href="<?php echo "/i?editedid="; htmlout($image['id'])?>">
				<div class="image" style="background-image: url('/editedthumbs/<?php htmlout($image['url']);?>');">
					<div style="height: 25px; top: 130px;" class="imagelabel">
						<p style="font-size: 25px; font-family: 'BebasNeue'; color: #dc4343; text-align: center;" class="stdtext"><?php htmlout($image['likesnumber']); ?></p>
					</div>
				</div>
			</a>
		<?php endforeach;
		else:
			echo "<p class='stdtext'>This user has not edited any pictures yet.</p>";
		endif; ?>
		</div>
			
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>