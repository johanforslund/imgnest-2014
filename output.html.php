<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>

<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Whether you are in need of getting an image edited - or searching for images to edit - this is the website for you.">
<title>IMGnest - Image Editing Help For Free</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/head.html.php'; ?>
</head>

<body>

<div class="wrap">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/' . $headertype . 'Header.html.php'; ?>

	<div class="ALL">
			
			<div class="siteinformationwrap">
				<div class="siteinformation1">
					<h2 class="informationheader">WELCOME</h2>
					<p>IMGnest is a community-based image editing website. Here you can upload an image which you want edited - OR - you can help others by editing their images.</p><br />
					<p>100% free. Easy. Fast.</p>
				</div>
				<div class="siteinformation2">
					<h2 class="informationheader">NEWS</h2>
					<p style="text-align: center;"><strong>Share edits</strong></p>
					<p>It is now possible to share edited images on FB and Twitter. More work in progress... Stay tuned!</p>
				</div>
				<div class="siteinformation3">
					<h2 class="informationheader">TOP EDITS</h2>
					
					<table style="border-collapse: collapse;">
						<tr>
							<td style="padding-bottom: 5px; border-bottom: 1px solid black;">
								<p style="display: inline-block;">
									<a href="/i/?editedid=<?php htmlout($topedits[0]['editedid']); ?>">
										<?php htmlout($topedits[0]['title']); ?> - <?php htmlout($topedits[0]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-bottom: 5px; border-bottom: 1px solid black;">
								<i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topedits[0]['likes_counter']); ?>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid black;">
								<p style="display: inline-block;">
									<a href="/i/?editedid=<?php htmlout($topedits[1]['editedid']); ?>">
										<?php htmlout($topedits[1]['title']); ?> - <?php htmlout($topedits[1]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid black;">
								<i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topedits[1]['likes_counter']); ?>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px;">
								<p style="display: inline-block;">
									<a href="/i/?editedid=<?php htmlout($topedits[2]['editedid']); ?>">
										<?php htmlout($topedits[2]['title']); ?> - <?php htmlout($topedits[2]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-top: 5px;"><i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topedits[2]['likes_counter']); ?>
								</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="siteinformation4">
					<h2 class="informationheader">TOP EDITORS</h2>
					
					<table style="border-collapse: collapse; margin: 0 auto; width: 100%;">
						<tr>
							<td style="padding-bottom: 5px; border-bottom: 1px solid black;">
								<p style="display: inline-block;">
									<a href="/profile/?profileid=<?php htmlout($topeditors[0]['user_name']); ?>">
										<?php htmlout($topeditors[0]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-bottom: 5px; border-bottom: 1px solid black;">
								<i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topeditors[0]['likes_count']); ?>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid black;">
								<p style="display: inline-block;">
									<a href="/profile/?profileid=<?php htmlout($topeditors[1]['user_name']); ?>">
										<?php htmlout($topeditors[1]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid black;">
								<i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topeditors[1]['likes_count']); ?>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px;">
								<p style="display: inline-block;">
									<a href="/profile/?profileid=<?php htmlout($topeditors[2]['user_name']); ?>">
										<?php htmlout($topeditors[2]['user_name']); ?>
									</a>
								</p>
							</td>
							<td style="padding-top: 5px;">
								<i style="color: #dc4343;" class="fa fa-star"></i>
								<p style="color: #dc4343; display: inline-block;">
									<?php htmlout($topeditors[2]['likes_count']); ?>
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="catmenu">
				<div class="browseedit">
					<h1 class="stdheader" style="position: absolute;">Browse and edit</h1>
				</div>
				<div class="cats">
					<p class="catstext"><a style="<?php echo $allstyle; ?>" href="?">ALL</a></p>
					<p class="catstext"><a style="<?php echo $colorizestyle; ?>" href="?category=colorize">COLORIZE</a></p>
					<p class="catstext"><a style="<?php echo $effectsstyle; ?>" href="?category=effects">EFFECTS</a></p>
					<p class="catstext"><a style="<?php echo $logosstyle; ?>" href="?category=logos">LOGOS</a></p>
					<p class="catstext"><a style="<?php echo $removestyle; ?>" href="?category=remove">REMOVE</a></p>
					<p class="catstext"><a style="<?php echo $restorestyle; ?>" href="?category=restore">RESTORE</a></p>
					<p class="catstext" style="margin-right: 0;"><a style="<?php echo $retouchstyle; ?>" href="?category=retouch">RETOUCH</a></p>
				</div>
				<div class="uploadcontainer">
					<a href="upload"><div class="uploadbutton"><p class="uploadbuttontext">UPLOAD</p></div></a>
				</div>
			</div>
			
			<div class="imagescontainer">
			<?php foreach($images as $image): ?>
				<a href="<?php echo "i?imageid="; htmlout($image['id'])?>">
					<div class="image" style="background-image: url('/thumbs/<?php htmlout($image['url']);?>');">
						<div class="imageamount"><p><?php htmlout($image['amount']);?>$</p></div>
						<div class="imagelabel">
							<p class="labeltext"><?php htmlout($image['title']); ?></p>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
			</div>
			
			<div style="text-align: center; width: 1200px;"><?php echo pagination($pdo, $statement,$limit,$page, $urlref, $categoryset);?></div>
			
			
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/footer.html.php'; ?>

</body>
</html>