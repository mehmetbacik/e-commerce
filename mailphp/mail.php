<?
require_once '../../admin/system/connect.php';
require("class.phpmailer.php");

if ($_POST['total']!=$_POST['process']) {
	echo "Bot control";
	exit;
} {
	//We are pulling our mail information from Mysql.
	$settingcontrol=$db->prepare("SELECT * FROM setting WHERE setting_id=?");
	$settingcontrol->execute(array(0));
	$settingbring=$settingcontrol->fetch(PDO::FETCH_ASSOC);


	$mail = new PHPMailer();
	$mail->IsSMTP();  
	$mail->CharSet="SET NAMES UTF8";  // send via SMTP
	$mail->Host     = $settingbring['setting_smtphost']; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = $settingbring['setting_smtpuser'];  // SMTP username
	$mail->Password = $settingbring['setting_smtppassword'];// SMTP password
	$mail->Port     = $settingbring['setting_smtpport'];
	$mail->From     = $settingbring['setting_smtpuser']; // Must be the same as your SMTP username
	$mail->Fromname = "Project Test Mail";
	//Duplicate this line for multiple mails
	$mail->AddAddress("mail@domain.com.tr","Form Mail");
	
	$mail->Subject  =  $_POST['namesurname'];
	$mail->Body     =  implode("    ",$_POST);

if(!$mail->Send())
{
	echo "Message could not be sent";
	echo "Mailer Error: " . $mail->ErrorInfo;
	exit;
}

echo "Message Sent";
exit;
}

?>
<!--<meta http-equiv="refresh" content="0;URL=../contact.php?status=success">-->