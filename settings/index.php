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
	header('Location: /imgnest');
	exit();
}

if(isset($_GET['save']))
{
	if($_GET['save']=='newsletter')
	{	
		if($_POST['newsletter']=='Yes')
		{
			try
			{
				$sql = 'DELETE FROM newsletter WHERE userid = :userid OR email = :email';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userid', $_SESSION['user_id']);
				$s->bindValue(':email', $_SESSION['user_email']);
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
				$sql = 'INSERT INTO newsletter SET email = :email, userid = :userid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':email', $_SESSION['user_email']);
				$s->bindValue(':userid', $_SESSION['user_id']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Unable to query sql.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			
			header('Location: ?newsletter&success');
			exit();
		}
		else if($_POST['newsletter']=='No')
		{
			try
			{
				$sql = 'DELETE FROM newsletter WHERE userid = :userid OR email = :email';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userid', $_SESSION['user_id']);
				$s->bindValue(':email', $_SESSION['user_email']);
				$s->execute();
			}
			catch(PDOException $e)
			{
				$error = 'Unable to query sql.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			header('Location: ?newsletter&success');
			exit();
		}
		else
		{
			header('Location: .');
			exit();
		}
		
	}
	else if($_GET['save']=='email')
	{
		if(isset($_POST['user_edit_submit_email']))
		{
			
			$currentemail = $GLOBALS['oldemail'];
			try
			{
				$sql = 'SELECT * FROM newsletter WHERE userid = :userid OR email = :email';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userid', $_SESSION['user_id']);
				$s->bindValue(':email', $currentemail);
				$s->execute();
				$total = $s->rowCount();
			}
			catch(PDOException $e)
			{
				$error = 'Unable to query sql.';
				include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
				exit();
			}
			
			if($total>0)
			{			
				try
				{
					$sql = 'DELETE FROM newsletter WHERE userid = :userid OR email = :email';
					$s = $pdo->prepare($sql);
					$s->bindValue(':userid', $_SESSION['user_id']);
					$s->bindValue(':email', $currentemail);
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
					$sql = 'INSERT INTO newsletter SET email = :email, userid = :userid';
					$s = $pdo->prepare($sql);
					$s->bindValue(':email', $_SESSION['user_email']);
					$s->bindValue(':userid', $_SESSION['user_id']);
					$s->execute();
				}
				catch(PDOException $e)
				{
					$error = 'Unable to query sql.';
					include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
					exit();
				}
			}

			if ($login->errors)
			{
				foreach ($login->errors as $error)
				{
					$message = $error;
				}
			}
			else
			{
				header('Location: ?changeemail&success');
			}
		}
		
	}
	else if($_GET['save']=='password')
	{
		if(isset($_POST['user_edit_submit_password']))
		{
			if ($login->errors)
			{
				foreach ($login->errors as $error)
				{
					$message = $error;
				}
			}
			else
			{
				header('Location: ?changepassword&success');
			}
		}
	}
	
}

try
{
	$sql = 'SELECT * FROM newsletter WHERE userid = :userid OR email = :email';
	$s = $pdo->prepare($sql);
	$s->bindValue(':userid', $_SESSION['user_id']);
	$s->bindValue(':email', $_SESSION['user_email']);
	$s->execute();
	$total = $s->rowCount();
}
catch(PDOException $e)
{
	$error = 'Unable to query sql.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

if($total == 0)
{
	$yes = '';
	$no = 'checked';
}
else if($total > 0)
{
	$yes = 'checked';
	$no = '';
}

if(isset($_GET['general']))
{
	include 'general.html.php';
	exit();
}
else if(isset($_GET['changeemail']))
{
	include 'changeemail.html.php';
	exit();
}
else if(isset($_GET['changepassword']))
{
	include 'changepassword.html.php';
	exit();
}

include 'general.html.php';