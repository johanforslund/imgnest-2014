<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
if ($login->isUserLoggedIn() == true)
{
	$headertype = 'user';
}
else
{
	$headertype = 'guest';
}
if(isset($_GET['submit']))
{
	if($login->isUserLoggedIn() == false)
	{
		header('Location: /signup');
		exit();
	}
	else
	{
		$error = '';
		$message = '';
		include 'submit.html.php';
		exit();
	}
}
if(isset($_GET['submitsent']))
{
	if($login->isUserLoggedIn() == false)
	{
		header('Location: /login');
		exit();
	}
	else
	{
		try
		{
			$sql = 'SELECT amount FROM submittedimages WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['submittedimage']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving images amount from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		$result = $s->fetch();
		$amount = $result['amount'];

		$filename = $_FILES['image']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$file = time() . $_SESSION['user_id'] . '.' . $ext;
		if($amount>0)
		{
			$target2 = "/lockedimages/";
		}
		else
		{
			$target2 = "/editedimages/";
		}
		$target = ".." . $target2 . $file;
		$valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png", ".JPG", ".JPEG", ".GIF", ".PNG");
		$file_extension = strrchr($_FILES["image"]["name"], ".");
		if(!in_array($file_extension, $valid_file_extensions))
		{
			$message = $_POST['message'];
			$error = 'Invalid file type.';
			include 'submit.html.php';
			exit();
		}
		if (!getimagesize($_FILES['image']['tmp_name']))
		{
			$message = $_POST['message'];
			$error = 'Uploaded file is not a valid image.';
			include 'submit.html.php';
			exit();
		}
		if ($_FILES['image']["size"] > 8000000)
		{
			$message = $_POST['message'];
			$error = 'Uploaded file size is too big.';
			include 'submit.html.php';
			exit();
		}
		if(!move_uploaded_file($_FILES['image']['tmp_name'], $target))
		{
			$message = $_POST['message'];
			$error = 'Invalid file type.';
			include 'submit.html.php';
			exit();
		}
		require $_SERVER['DOCUMENT_ROOT'] .  '/includes/thumbgenerator/thumb.php';
		createthumb($_SERVER['DOCUMENT_ROOT'] .  $target2 . $file,
					$_SERVER['DOCUMENT_ROOT'] .  '/editedthumbs/' . $file,
					215,
					155
					);
		try
		{
			$sql = 'SELECT title, userid FROM submittedimages WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['submittedimage']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Unable to get userid for image.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		$result = $s->fetch();

		if($amount>0)
		{
			$locked = 1;
		}
		else
		{
			$locked = 0;
		}
		try
		{
			$sql = 'INSERT INTO editedimages SET
				url = :url,
				fromuser = :fromuser,
				touser = :touser,
				submittedimage = :submittedimage,
				locked = :locked';
			$s = $pdo->prepare($sql);
			$s->bindValue(':url', $file);
			$s->bindValue(':fromuser', $_SESSION['user_id']);
			$s->bindValue(':touser', $result['userid']);
			$s->bindValue(':submittedimage', $_POST['submittedimage']);
			$s->bindValue(':locked', $locked);
			$s->execute();
			$lastid = $pdo->lastInsertId();
		}
		catch(PDOException $e)
		{
			$error = 'Unable to insert in database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}

		try
		{
			$sql = 'INSERT INTO messages SET
				sender = :sender,
				title = :title,
				messagetext = :messagetext,
				fromuser = :fromuser,
				touser = :touser';
			$s = $pdo->prepare($sql);
			$s->bindValue(':sender', 'IMGnest');
			$s->bindValue(':title', 'You have got an response');
			$s->bindValue(':messagetext',
						  '__' . $_SESSION['user_name'] . '__ has sent you an edited response to your picture: __' . $result['title'] . '__. Click [here](/i/?editedid=' . $lastid . ') to view it. \n\n The user added this message: \n\n _' . $_POST['message'] . '_');
			$s->bindValue(':fromuser', $_SESSION['user_id']);
			$s->bindValue(':touser', $result['userid']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Unable to insert message to database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}

		try
		{
			$sql = 'SELECT user_email FROM users where user_id = :user_id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':user_id', $result['userid']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Unable to fetch user email.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		$result = $s->fetch();

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "mail.imgnest.com";
		$mail->SMTPDebug  = 2;
		$mail->SMTPAuth = true;
		$mail->Port = 26;
		$mail->Username = "noreply@imgnest.com";
		$mail->Password = "???";
		$mail->SetFrom("noreply@imgnest.com", "IMGnest");
		$mail->Subject = "Reply on your uploaded image.";
		$link = "http://www.imgnest.com/i/?editedid=" . $lastid;
		$mail->Body = 	"<!DOCTYPE html>
						<html>
						<head>
						</head>
						<body>
							<h1>IMGnest</h1>
							<hr />
							<p>Someone has edited your image:</p>
							<a style='font-size: 18px' href='$link'>Click here to view it.</a>
							<p><em>Make sure to say thanks if you like it</em></p>
						</body>
						</html>";
		$mail->isHTML(true);
		$address = $result['user_email'];
		$mail->AddAddress($address, $address);

		$mail->Send();

		header('Location: /i/?editedid=' . $lastid);
		exit();
	}
}

if(isset($_GET['addeditcomment']))
{
	if(isset($_POST['comment']))
	{
		if ($login->isUserLoggedIn() == true)
		{
			try
			{
				$sql = 'INSERT INTO editcomments SET fromuser = :fromuser, commenttext = :commenttext, editedid = :editedid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':fromuser', $_SESSION['user_name']);
				$s->bindValue(':commenttext', $_POST['commenttext']);
				$s->bindValue(':editedid', $_POST['editedid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Unable to insert comment into database.' . $e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}

			try
			{
				$sql = 'SELECT id, fromuser FROM editedimages WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_GET['editedid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error retreiving info about image from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			$result = $s->fetch();

			if($_SESSION['user_id'] != $result['fromuser'])
			{
				try
				{
					$sql = 'INSERT INTO messages SET
						sender = :sender,
						title = :title,
						messagetext = :messagetext,
						fromuser = :fromuser,
						touser = :touser';
					$s = $pdo->prepare($sql);
					$s->bindValue(':sender', 'IMGnest');
					$s->bindValue(':title', 'Comment on your edit');
					$s->bindValue(':messagetext',
								  '__' . $_SESSION['user_name'] . '__ has commented on one of your edits. Click [here](/i/?editedid=' . $result['id'] . ') to read it.');
					$s->bindValue(':fromuser', $_SESSION['user_id']);
					$s->bindValue(':touser', $result['fromuser']);
					$s->execute();
				}
				catch(PDOException $e)
				{
					$error = 'Unable to insert message to database.';
					include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
					exit();
				}
			}
		}

		header('Location: /i/?editedid=' . $_POST['editedid']);
		exit();
	}
}

if(isset($_GET['addsubmitcomment']))
{
	if(isset($_POST['comment']))
	{
		if ($login->isUserLoggedIn() == true)
		{
			try
			{
				$sql = 'INSERT INTO submitcomments SET fromuser = :fromuser, commenttext = :commenttext, submittedid = :submittedid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':fromuser', $_SESSION['user_name']);
				$s->bindValue(':commenttext', $_POST['commenttext']);
				$s->bindValue(':submittedid', $_POST['submittedid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Unable to insert comment into database.' . $e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}

			try
			{
				$sql = 'SELECT id, userid FROM submittedimages WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_GET['imageid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error retreiving info about image from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			$result = $s->fetch();

			if($_SESSION['user_id'] != $result['userid'])
			{
				try
				{
					$sql = 'INSERT INTO messages SET
						sender = :sender,
						title = :title,
						messagetext = :messagetext,
						fromuser = :fromuser,
						touser = :touser';
					$s = $pdo->prepare($sql);
					$s->bindValue(':sender', 'IMGnest');
					$s->bindValue(':title', 'Comment on your uploaded image');
					$s->bindValue(':messagetext',
								  '__' . $_SESSION['user_name'] . '__ has commented on your uploaded image. Click [here](/i/?imageid=' . $result['id'] . ') to read it.');
					$s->bindValue(':fromuser', $_SESSION['user_id']);
					$s->bindValue(':touser', $result['userid']);
					$s->execute();
				}
				catch(PDOException $e)
				{
					$error = 'Unable to insert message to database.';
					include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
					exit();
				}
			}
		}

		header('Location: /i/?imageid=' . $_POST['submittedid']);
		exit();
	}
}

if(isset($_GET['editedid']))
{
	try
	{
		$sql = 'SELECT submittedimage, locked FROM editedimages WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_GET['editedid']);
		$s->execute();
		$total = $s->rowCount();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to retrieve submitted image id.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	$result = $s->fetch();
	if($total == 0)
	{
		$error = 'Incorrect edited id.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	try
	{
		$sql = 'SELECT id, url, date, userid, title, description, amount FROM submittedimages WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $result['submittedimage']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving info about image from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	$result2 = $s->fetch();
	try
	{
		$sql = 'SELECT url, date, fromuser FROM editedimages WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_GET['editedid']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving info about image from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	$result3 = $s->fetch();
	try
	{
		$sql = 'SELECT user_name FROM users WHERE user_id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $result2['userid']);
		$s->execute();
	}
	catch(PDOException $e)
	{		$error = 'Error retreiving username from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	$result4 = $s->fetch();
	try
	{
		$sql = 'SELECT user_name FROM users WHERE user_id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $result3['fromuser']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving username from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';		exit();
	}
	$result5 = $s->fetch();
	$editedlocked = $result['locked'];
	$submittedid = $result2['id'];	$submittedurl = $result2['url'];
	$submitteddate = date_create($result2['date']);
	$submitteduserid = $result2['userid'];
	$submittedusername = $result4['user_name'];
	$submittedtitle = $result2['title'];
	$submitteddescription = $result2['description'];
	$submittedamount = $result2['amount'];
	if($submittedusername == '')
	{
		$submittedusername = '[deleted]';
	}
	$editedurl = $result3['url'];
	$editeddate = date_create($result3['date']);
	$editeduserid = $result3['fromuser'];
	$editedusername = $result5['user_name'];		if($editedusername == '')
	{
		$editedusername = '[deleted]';
	}
	if ($login->isUserLoggedIn() == true)
	{
		$color = 'white';
		try
		{
			$sql = 'SELECT userid FROM likes WHERE userid = :userid AND editedid = :editedid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':userid', $_SESSION['user_id']);
			$s->bindValue(':editedid', $_GET['editedid']);
			$s->execute();
			$total = $s->rowCount();
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		if(isset($_GET['like']))
		{
			if($total < 1 && ($_SESSION['user_id'] != $editeduserid))
			{
				try
				{
					$sql = 'INSERT INTO likes SET userid = :userid, editedid = :editedid';
					$s = $pdo->prepare($sql);
					$s->bindValue(':userid', $_SESSION['user_id']);
					$s->bindValue(':editedid', $_GET['editedid']);
					$s->execute();
				}
				catch(PDOException $e)
				{
					$error = 'Error inserting like into database.';
					include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
					exit();
				}
			}
		}

		if(isset($_GET['delete']) && $editeduserid == $_SESSION['user_id'])
		{
			try
			{
				$sql = 'DELETE FROM editedimages WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_GET['editedid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error deleting image from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			try
			{
				$sql = 'DELETE FROM editcomments WHERE editedid = :editedid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':editedid', $_GET['editedid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error deleting comments from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			header('Location: /i?imageid=' . $submittedid);
			exit();
		}

		try
		{
			$sql = 'SELECT userid FROM likes WHERE userid = :userid AND editedid = :editedid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':userid', $_SESSION['user_id']);
			$s->bindValue(':editedid', $_GET['editedid']);
			$s->execute();
			$total = $s->rowCount();
			$mylikes = $total;
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
	}
	try
	{
		$sql = 'SELECT * FROM likes WHERE editedid = :editedid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':editedid', $_GET['editedid']);
		$s->execute();
		$likesnumber = $s->rowCount();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving likes from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}

	try
	{
		$sql = 'SELECT * FROM editcomments WHERE editedid = :editedid ORDER BY date DESC';
		$s = $pdo->prepare($sql);
		$s->bindValue(':editedid', $_GET['editedid']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving comments from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}

	foreach($s as $comment)
	{
		$comments[] = array(
			'fromuser' => $comment['fromuser'],
			'commenttext' => $comment['commenttext'],
			'date' => strtotime($comment['date']));
	}

	try
	{
		$sql = 'SELECT id, url, fromuser FROM editedimages WHERE submittedimage = :submittedimage';
		$s = $pdo->prepare($sql);
		$s->bindValue(':submittedimage', $submittedid);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving previews of submitted images from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}

	foreach($s as $row)
	{
		try
		{
			$sql = 'SELECT user_name FROM users WHERE user_id = :user_id';
			$t = $pdo->prepare($sql);
			$t->bindValue(':user_id', $row['fromuser']);
			$t->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Error getting usernames from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		$result = $t->fetch();

		try
		{
			$sql = 'SELECT * FROM likes WHERE editedid = :editedid';
			$u = $pdo->prepare($sql);
			$u->bindValue(':editedid', $row['id']);
			$u->execute();			$editlikes = $u->rowCount();
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}

		$previewimages[] = array(
			'id' => $row['id'],
			'url' => $row['url'],
			'user_name' => $result['user_name'],
			'likesnumber' => $editlikes);
	}

		try
		{
			$sql = 'SELECT * FROM likes LEFT JOIN editedimages on likes.editedid = editedimages.id WHERE fromuser = :fromuser';
			$s = $pdo->prepare($sql);
			$s->bindValue(':fromuser', $editeduserid);
			$s->execute();
			$total = $s->rowCount();
			$edituserlikes = $total;
		}
		catch(PDOException $e)
		{
			$error = 'Unable to fetch likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		try
		{
			$sql = 'SELECT * FROM likes LEFT JOIN editedimages on likes.editedid = editedimages.id WHERE fromuser = :fromuser';
			$s = $pdo->prepare($sql);
			$s->bindValue(':fromuser', $submitteduserid);
			$s->execute();
			$total = $s->rowCount();
			$submitteduserlikes = $total;
		}
		catch(PDOException $e)
		{
			$error = 'Unable to fetch likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
	include 'viewedited.html.php';
	exit();
}

if(!isset($_GET['imageid']))
{
	$error = 'No image id is set.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

try
{
	$sql = 'SELECT title, description, category, date, userid, url, amount FROM submittedimages WHERE id = :id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $_GET['imageid']);
	$s->execute();
	$total = $s->rowCount();
}
catch (PDOException $e)
{
	$error = 'Error getting image information from database.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

$row = $s->fetch();

if($total == 0)
{
	$error = 'Incorrect image id.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

try
{
	$sql = 'SELECT user_name FROM users WHERE user_id = :user_id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':user_id', $row['userid']);
	$s->execute();
}

catch(PDOException $e)
{
	$error = 'Error retrieving username from database.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

$row2 = $s->fetch();
$title = $row['title'];
$description = $row['description'];
$submitteduserid = $row['userid'];
$category = $row['category'];
$date = date_create($row['date']);
$url = $row['url'];
$amount = $row['amount'];
$username = $row2['user_name'];
if($username == '')
{
	$username = '[deleted]';
}
if ($login->isUserLoggedIn() == true)
{
	$headertype = 'user';
	$downloadlink = '/submittedimages/' . $url;
	$autodownload = 'download';
}
else
{
	$headertype = 'guest';
	$downloadlink = '/submittedimages/' . $url;
	$autodownload= 'download';
}

$downloadtext = str_replace(array('.', ','), '' , $title);

if(isset($_GET['imageid']))
{
	if(isset($_GET['delete']) && $submitteduserid == $_SESSION['user_id'])
		{
			try
			{
				$sql = 'DELETE FROM submittedimages WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_GET['imageid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error deleting image from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			try
			{
				$sql = 'DELETE FROM submitcomments WHERE submittedid = :submittedid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':submittedid', $_GET['imageid']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Error deleting comments from database.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			header('Location: /');
			exit();
		}

	try
	{
		$sql = 'SELECT id, url, fromuser, locked FROM editedimages WHERE submittedimage = :submittedimage';
		$s = $pdo->prepare($sql);
		$s->bindValue(':submittedimage', $_GET['imageid']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Error retreiving previews of submitted images from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}

	foreach($s as $row)
	{
		try
		{
			$sql = 'SELECT user_name FROM users WHERE user_id = :user_id';
			$t = $pdo->prepare($sql);
			$t->bindValue(':user_id', $row['fromuser']);
			$t->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Error getting usernames from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}

		$result = $t->fetch();

		try
		{
			$sql = 'SELECT * FROM likes WHERE editedid = :editedid';
			$u = $pdo->prepare($sql);
			$u->bindValue(':editedid', $row['id']);
			$u->execute();
			$likesnumber = $u->rowCount();
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}

		$previewimages[] = array(
				'id' => $row['id'],
				'url' => $row['url'],
				'locked' => $row['locked'],
				'user_name' => $result['user_name'],
				'likesnumber' => $likesnumber);
	}
}

try
{
	$sql = 'SELECT * FROM submitcomments WHERE submittedid = :submittedimage ORDER BY date DESC';
	$s = $pdo->prepare($sql);
	$s->bindValue(':submittedimage', $_GET['imageid']);
	$s->execute();
}
catch(PDOException $e)
{
	$error = 'Error retreiving comments from database.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

foreach($s as $comment)
{
	$comments[] = array(
		'fromuser' => $comment['fromuser'],
		'commenttext' => $comment['commenttext'],
		'date' => strtotime($comment['date']));
}

include 'i.html.php';
