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

if(isset($_POST['submit']))
{
	try
	{
		$sql = 'SELECT id FROM newsletter WHERE email = :email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $_POST['email']);
		$s->execute();
		$total = $s->rowCount();
	}
	catch(PDOException $e)
	{
		$error = 'Error checking for email in database';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	if($total>0)
	{
		$error = 'This email is already in the newsletter list.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	if($_POST['email'] == '' OR $_POST['email'] == ' ' OR !isset($_POST['email']))
	{
		$error = 'Empty email address.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$error = 'Incorrect email address.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	
	if ($login->isUserLoggedIn() == true) 
	{			
		$headertype = 'user';
		try
		{
			$sql = 'INSERT INTO newsletter SET
				email = :email,
				userid = :userid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':email', $_POST['email']);
			$s->bindValue(':userid', $_SESSION['user_id']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Error inserting email into database';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
	}
	else
	{
		$headertype = 'guest';
		try
		{
			$sql = 'INSERT INTO newsletter SET
				email = :email';
			$s = $pdo->prepare($sql);
			$s->bindValue(':email', $_POST['email']);
			$s->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Error inserting email into database';
			include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
			exit();
		}
	}
	include 'newsletter.html.php';
}

