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

include 'readmore.html.php';