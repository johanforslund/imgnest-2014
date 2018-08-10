<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login/index.php';
$login = new Login();
$headertype = 'guest';

if ($login->errors) {
    foreach ($login->errors as $error) {
        $errors = $error;
    }
}
else
{
	$errors = '';
}

if($login->isUserLoggedIn() == true)
{
	header('Location: /');
	exit();
}
else
{
	include 'login.html.php';
}
	
/*
	}
else
{
	$headertype = 'guest';
	include 'login.html.php';
	exit();
}
*/