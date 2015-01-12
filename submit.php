<?php

/* config start */

$emailAddress = 'david@101accountingandtaxes.com';

/* config end */


require "phpmailer/class.phpmailer.php";

session_name("fancyform");
session_start();


foreach($_POST as $k=>$v)
{
	if(ini_get('magic_quotes_gpc'))
	$_POST[$k]=stripslashes($_POST[$k]);
	
	$_POST[$k]=htmlspecialchars(strip_tags($_POST[$k]));
}


$err = array();

if(!empty($_POST['subject']))
	$err[]='robot!';

/*if(!checkLen('last_name'))
	$err[]='The name field is too short or empty!';

/*if(!checkLen('email'))
	$err[]='The email field is too short or empty!';
else if(!checkEmail($_POST['email']))
	$err[]='Your email is not valid!';*/


/*if(!checkLen('message'))
	$err[]='The message field is too short or empty!';*/


if(count($err))
{
	if($_POST['ajax'])
	{
		echo '-1';
	}

	else if($_SERVER['HTTP_REFERER'])
	{
		$_SESSION['errStr'] = implode('<br />',$err);
		$_SESSION['post']=$_POST;
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

	exit;
}


$msg=
'Name:	'.$_POST['first_name'].' '.$_POST['last_name'].'<br />
Email:	'.$_POST['email'].'<br />
IP:	'.$_SERVER['REMOTE_ADDR'].'<br /><br />

Message:<br /><br />
First Name: '.$_POST['first_name'].'<br/>
Last Name: '.$_POST['last_name'].'<br/>
Email: '.$_POST['email'].'<br/>
Job Title: '.$_POST['job_title'].'<br/>
Company: '.$_POST['company'].'<br/>
Address Line 1: '.$_POST['address1'].'<br/>
Address Line 2: '.$_POST['address2'].'<br/>
City: '.$_POST['city'].'<br/>
State: '.$_POST['state'].'<br/>
Zip Code: '.$_POST['zip_code'].'<br/>
Phone: '.$_POST['phone'].'<br/>
Fax: '.$_POST['fax'].'<br/>';


$mail = new PHPMailer();
$mail->IsMail();

$mail->AddReplyTo($_POST['email'],  $_POST['first_name'].' '.$_POST['last_name']);
$mail->AddAddress($emailAddress);
$mail->SetFrom($_POST['email'], $_POST['first_name'].' '.$_POST['last_name']);
$mail->Subject = "[101accountingandtaxes] Website Form ";

$mail->MsgHTML($msg);

$mail->Send();


unset($_SESSION['post']);

if($_POST['ajax'])
{
	echo '1';
}
else
{
	$_SESSION['sent']=1;
	
	if($_SERVER['HTTP_REFERER'])
		header('Location: '.$_SERVER['HTTP_REFERER']);
	
	exit;
}

function checkLen($str,$len=2)
{
	return isset($_POST[$str]) && mb_strlen(strip_tags($_POST[$str]),"utf-8") > $len;
}

function checkEmail($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

?>
