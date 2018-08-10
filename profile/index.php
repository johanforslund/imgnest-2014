<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/pagination/function.php';

if ($login->isUserLoggedIn() == true) 
{	
	$headertype = 'user';	
}
else
{
	$headertype = 'guest';
}

if(isset($_GET['profileid']))
{
	try
	{
		$sql = 'SELECT user_id FROM users WHERE user_name = :user_name';
		$s = $pdo->prepare($sql);
		$s->bindValue(':user_name', $_GET['profileid']);
		$s->execute();
		$total = $s->rowCount();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	$result = $s->fetch();
	
	$fromuser = $result['user_id'];
	
	if($total==0)
	{
		$error = 'Incorrect profile id.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	try
	{
		$sql = 'SELECT url, id FROM editedimages WHERE fromuser = :fromuser ORDER BY date DESC';
		$s = $pdo->prepare($sql);
		$s->bindValue(':fromuser', $fromuser);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	try
	{
		$sql = 'SELECT user_registration_datetime FROM users WHERE user_id = :user_id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':user_id', $fromuser);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	$result = $s->fetch();
	
	$date = $result['user_registration_datetime'];
	$date = strtotime($date);
	$todaydate = time();
	$exactdayssince = ($todaydate - $date) / (60*60*24);
	$dayssince = round($exactdayssince);
	
	try
	{
		$sql = 'SELECT * FROM likes LEFT JOIN editedimages on likes.editedid = editedimages.id WHERE fromuser = :fromuser';
		$s = $pdo->prepare($sql);
		$s->bindValue(':fromuser', $fromuser);
		$s->execute();
		$total = $s->rowCount();
		$myLikes = $total;
	}
	catch(PDOException $e)
	{
		$error = 'Unable to fetch likes from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	try
	{
		$sql = 'SELECT id, url FROM editedimages WHERE fromuser = :fromuser ORDER BY date DESC';
		$s = $pdo->prepare($sql);
		$s->bindValue(':fromuser', $fromuser);
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
			$sql = 'SELECT * FROM likes WHERE editedid = :editedid';
			$u = $pdo->prepare($sql);
			$u->bindValue(':editedid', $row['id']);
			$u->execute();
			$editlikes = $u->rowCount();
		}
		catch(PDOException $e)
		{
			$error = 'Error retreiving likes from database.';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
		
		$images[] = array(
			'id' => $row['id'],
			'url' => $row['url'],
			'likesnumber' => $editlikes);
	}

	include 'profile.html.php';
}
else if($login->isUserLoggedIn() == true)
{
	header('Location: ?profileid=' . $_SESSION['user_name']);
}
else
{
	$error = 'No profile id set.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}
