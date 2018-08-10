<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/includes/magicquotes.inc.php';
require '../includes/db.inc.php';

if ($login->isUserLoggedIn() == false) 
{	
	header('Location: /signup');
	exit();
}
else
{
	
	$error = '';
	$title = '';
	$description = '';
	$headertype = 'user';
	if(isset($_GET['upload']))
	{
		$filename = $_FILES['image']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$file = time() . $_SESSION['user_id'] . '.' . $ext;
		$target = "../submittedimages/";
		$target = $target . $file ;
		
		$valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png", ".JPG", ".JPEG", ".GIF", ".PNG");
		$file_extension = strrchr($_FILES["image"]["name"], ".");
		if(!in_array($file_extension, $valid_file_extensions))
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$error = 'Invalid file type.';
			include 'upload.html.php';
			exit();
		}
		
		if (!getimagesize($_FILES['image']['tmp_name'])) 
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$error = 'Uploaded file is not a valid image.';
			include 'upload.html.php';
			exit();
		}
		
		if ($_FILES['image']["size"] > 8000000)
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$error = 'Uploaded file size is too big.';
			include 'upload.html.php';
			exit();
		}
		
		if($_POST['title'] == '' OR $_POST['title'] == ' ' OR !isset($_POST['title']))
		{
			$title = '';
			$description = $_POST['description'];
			$error = 'Missing the title field.';
			include 'upload.html.php';
			exit();
		}
		
		if($_POST['description'] == '' OR $_POST['description'] == ' ' OR !isset($_POST['description']))
		{
			$title = $_POST['title'];
			$description = '';
			$error = 'Missing the description field.';
			include 'upload.html.php';
			exit();
		}
		
		if(!isset($_POST['formcat']))
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$error = 'No category selected.';
			include 'upload.html.php';
			exit();
		}
		
		if(!move_uploaded_file($_FILES['image']['tmp_name'], $target))
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$error = 'Unable to upload image.';
			include 'upload.html.php';
			exit();
		}
		
		require $_SERVER['DOCUMENT_ROOT'] .  '/includes/thumbgenerator/thumb.php';
		createthumb($_SERVER['DOCUMENT_ROOT'] .  '/submittedimages/' . $file, 
					$_SERVER['DOCUMENT_ROOT'] .  '/thumbs/' . $file,
					215,
					155
					);
		
		try
		{
			$sql = 'INSERT INTO submittedimages SET 
				title = :title,
				description = :description,
				category = :category,
				url = :url,
				userid = :userid,
				amount = :amount';
			$s = $pdo->prepare($sql);
			$s->bindValue(':title', $_POST['title']);
			$s->bindValue(':description', $_POST['description']);
			$s->bindValue(':category', $_POST['formcat']);
			$s->bindValue(':url', $file);
			$s->bindValue(':userid', $_SESSION['user_id']);
			$s->bindValue(':amount', $_POST['amount']);
			$s->execute();
			$lastid = $pdo->lastInsertId();
		}
		catch(PDOException $e)
		{
			$error = 'Unable to insert into database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		
		header('Location: /i/?imageid=' . $lastid);
		exit();
	}

	include 'upload.html.php';
}