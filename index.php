<?php
//Version 1

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/pagination/function.php';

$allstyle = '';
$colorizestyle = '';
$effectsstyle = '';
$logosstyle = '';
$removestyle = '';
$restorestyle = '';
$retouchstyle = '';
if(!isset($_GET['category']))
{
	$allstyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='colorize')
{
	$colorizestyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='effects')
{
	$effectsstyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='logos')
{
	$logosstyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='remove')
{
	$removestyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='restore')
{
	$restorestyle = 'border-bottom: 2px solid black;';
}
else if($_GET['category']=='retouch')
{
	$retouchstyle = 'border-bottom: 2px solid black;';
}

//PAGINATION
/*************************************************************/
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 15;
    	$startpoint = ($page * $limit) - $limit;
		if(isset($_GET['category']))
		{
			$urlref = '?category=' . $_GET['category'] . '&';
			$statement = "submittedimages WHERE category = :category";
			$categoryset = 1;
		}
		else
		{
			$urlref = '?';
			$statement = "submittedimages";
			$categoryset = 0;
		}
/*************************************************************/


if ($login->isUserLoggedIn() == true) 
{	
	$headertype = 'user';	
}
else
{
	$headertype = 'guest';
}

try
{
	$sql = 'SELECT user_name, title, editedimages.id, COUNT(users.user_id) AS likes_counter 
			FROM users, likes, editedimages, submittedimages 
			WHERE users.user_id = editedimages.fromuser AND likes.editedid = editedimages.id AND editedimages.submittedimage = submittedimages.id
			GROUP BY editedimages.id
			ORDER BY likes_counter DESC
			LIMIT 3';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$error = 'Unable to retreive statistics from database.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

foreach($s as $row)
{
	$topedits[] = array(
		'user_name' => $row['user_name'],
		'likes_counter' => $row['likes_counter'],
		'title' => $row['title'],
		'editedid' => $row['id']);
}

try
{
	$sql = 'SELECT 
				a.user_name, 
				COUNT(c.editedid) AS likes_count
			FROM 
				users a
			LEFT JOIN editedimages b
				ON a.user_id = b.fromuser
			LEFT JOIN likes c
				ON b.id = c.editedid
			GROUP BY
				a.user_id
			ORDER BY 
				likes_count DESC
			LIMIT 3';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$error = 'Unable to retreive statistics from database.';
	include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
	exit();
}

foreach($s as $row)
{
	$topeditors[] = array(
		'user_name' => $row['user_name'],
		'likes_count' => $row['likes_count']);
}

if(isset($_GET['category']))
{
	try
	{
		$result = $pdo->prepare('SELECT title, url, id, amount FROM submittedimages WHERE category = :category ORDER BY date DESC LIMIT '.$startpoint.' , '.$limit);
		$result->bindValue(':category', $_GET['category']);
		$result->execute();
		$total = $result->rowCount();
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
	if($total == 0)
	{
		$error = 'Incorrect category id.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
}
else
{
	try
	{
		$result = $pdo->query('SELECT title, url, id, amount FROM submittedimages ORDER BY date DESC LIMIT '.$startpoint.' , '.$limit);
	}
	catch(PDOException $e)
	{
		$error = 'Unable to query sql.';
		include $_SERVER['DOCUMENT_ROOT'] . '/sharedhtml/error.html.php';
		exit();
	}
}



foreach($result as $row)
{
	$images[] = array(
		'title' => $row['title'],
		'url' => $row['url'],
		'id' => $row['id'],
		'amount' => $row['amount']);
}


include 'output.html.php';