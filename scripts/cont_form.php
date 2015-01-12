<?php 
$your_email ='david@101accountingandtaxes.com';// <<=== update to your email address

session_start();
$errors = '';
$name = '';
$company = '';
$email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	
	$company = $_POST['company'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$jobtitle = $_POST['jobtitle'];
	$phone = $_POST['phone'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	///------------Do Validations-------------
	if(empty($name)||empty($email))
	{
		$errors .= "";	
	}
	if(IsInjected($email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The code does not match!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $your_email;
		$subject="New form submission";
		$from = $email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = 
		"Name: $name\n".
		"Company: $company\n".
		"Job Title: $jobtitle\n".
		"Address: $address\n".
		"City: $city\n".
		"State: $state\n".
		"Zip Code: $zip\n".
		"Email: $email \n".
		"Phone: $phone\n".
		"Fax: $fax\n".		
		"Message: $message\n".
		"\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $email \r\n";
		
		mail($to, $subject, $body,$headers);
		
		header('Location: thank-you.html');
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font-family: Verdana, Geneva, sans-serif;
	color: gray;
	font-size: 11px;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.err {
	font-family : Verdana, Helvetica, sans-serif;
	font-size : 11px;
	color: green;
	font-weight: normal;
}


-->
</style>

<script language="JavaScript" src="gen_validatorv31.js" type="text/javascript"></script>	
</head>

<body>
<div class="contact" id="contact">
  <form 
action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="contact_form" id="contact_form">
    <table width="325" border="0" align="center" cellpadding="1" cellspacing="2">
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="170" align="right" valign="top"><strong>Name:</strong></td>
        <td width="316" align="left"><input name="name" type="text" value="<?php echo htmlentities($name) ?>"size="30"style="border: 2px solid #00a651" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Company:</strong></td>
        <td align="left"><input name="company" type="text" value="<?php echo htmlentities($company) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Job Title:</strong></td>
        <td align="left"><input name="jobtitle" type="text" id="jobtitle"style="border: 1px solid #999" value="<?php echo htmlentities($jobtitle) ?>"size="30" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Address:</strong></td>
        <td align="left"><input name="address" type="text" value="<?php echo htmlentities($address) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>City:</strong></td>
        <td align="left"><input name="city" type="text" value="<?php echo htmlentities($city) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>State:</strong></td>
        <td align="left"><input name="state" type="text" value="<?php echo htmlentities($state) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Zip code:</strong></td>
        <td align="left"><input name="zip" type="text" value="<?php echo htmlentities($zip) ?>"size="30"style="border: 2px solid #00a651" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Email:</strong></td>
        <td align="left"><input name="email" type="text" value="<?php echo htmlentities($email) ?>" size="30"style="border: 2px solid #00a651" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Phone:</strong></td>
        <td align="left"><input name="phone" type="text" value="<?php echo htmlentities($phome) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Fax:</strong></td>
        <td align="left"><input name="fax" type="text" value="<?php echo htmlentities($fax) ?>"size="30"style="border: 1px solid #999" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><p><strong>Comments:</strong></p></td>
        <td align="left"><textarea name="message" rows="4" cols="23"><?php echo htmlentities($message) ?></textarea></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><small>Can't read the image?
          click <a href='javascript: refreshCaptcha();'>here</a></small></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Code  here:</strong></td>
        <td align="left"><input name="6_letters_code" type="text" id="6_letters_code"style="border: 2px solid #00a651" size="23" maxlength="6" />          <span class="err">
            <?php
if(!empty($errors)){
echo "<class='err'>".nl2br($errors)."";
}
?>
          </span></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input type="submit" value="Submit Information" name='submit' /></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="18%">&nbsp;</td>
            <td width="82%" align="left"><div id='contact_form_errorloc' class='err'></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <p><br />
    </p>
  </form>
  <script language="JavaScript" type="text/javascript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();


frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("zip","req","Please provide your zip code"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
  <script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<noscript>
</noscript>
</div>
</body>
</html>