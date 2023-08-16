<?
require_once '../admin/system/connect.php';
require("class.phpmailer.php");

$user_mail=$_POST['user_mail'];
$usercheck=$db->prepare("SELECT * FROM user WHERE user_mail=:mail");
$usercheck->execute(array(
	'mail' => $user_mail
	));

$userbring=$usercheck->fetch(PDO::FETCH_ASSOC);

$user_id=$userbring['user_id'];

$say=$usercheck->rowCount();

if ($say) {
	
	$settingcheck=$db->prepare("SELECT * FROM setting WHERE setting_id=?");
	$settingcheck->execute(array(0));
	$settingbring=$settingcheck->fetch(PDO::FETCH_ASSOC);

	//Password Creat

	function create($length)
	{

		if(!is_numeric($length) || $length <= 0)
		{
			$length = 8;
		}
		if($length  > 32)
		{
			$length = 32;
		}

		$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

		mt_srand(microtime() * 1000000);

		for($i = 0; $i < $length; $i++)
		{
			$key = mt_rand(0,strlen($char)-1);
			$pwd = $pwd . $char{$key};
		}

		for($i = 0; $i < $length; $i++)
		{
			$key1 = mt_rand(0,strlen($pwd)-1);
			$key2 = mt_rand(0,strlen($pwd)-1);

			$tmp = $pwd{$key1};
			$pwd{$key1} = $pwd{$key2};
			$pwd{$key2} = $tmp;
		}

		return $pwd;
	}

	//Şifre Üretme
	$create=create(6); echo "<br>";
	$user_password=md5($create);

	$settingsave=$db->prepare("UPDATE user SET
		user_password=:password
		WHERE user_id={$user_id}");
	$update=$settingsave->execute(array(	
		'password' => $user_password
		));

	if ($update) {
		
		echo "Success";
	} else {

		echo "Error";
	}


	$subject="Password Reset";

	$mail = new PHPMailer();

	$mail->IsSMTP();  
$mail->Host     = $settingbring['setting_smtphost']; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $settingbring['setting_smtpuser'];  // SMTP username
$mail->Password = $settingbring['setting_smtppassword'];// SMTP password
$mail->Port     = $settingbring['setting_smtpport'];
$mail->From     = $settingbring['setting_smtpuser']; // must be the same as your smtp username
$mail->Fromname = "Password Reset";
$mail->AddAddress($_POST['user_mail'],"Password Reset");
$mail->CharSet="SET NAMES UTF8";                               // send via SMTP
$mail->Subject  =  $subject;
$mail->Body     =  "Your Password Has Been Reset Your New Password: $create";

if(!$mail->Send())
{
	echo "Message could not be sent <p>";
	echo "Mailer Error: " . $mail->ErrorInfo;
	exit;
}
echo "Message sent";
?>

<meta http-equiv="refresh" content="0;URL=../login.php">

<?php
}
?>



