<?PHP
require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();

$body = "ทดสอบการส่งอีเมล์ภาษาไทย UTF-8 ผ่าน SMTP Server ด้วย PHPMailer.";

$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Host = "smtp.yourdomain.com"; // SMTP server
$mail->Port = 25; // พอร์ท
$mail->Username = "jakrit000333@gmail.com"; // account SMTP
$mail->Password = "023536333"; // รหัสผ่าน SMTP

$mail->SetFrom("jakrit000333@gmail.com", "Jakrit");
$mail->AddReplyTo("jakrit000333@gmail.com", "yourname");
$mail->Subject = "ทดสอบ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("jakrit000333@gmail.com", "recipient1"); // ผู้รับคนที่หนึ่ง
$mail->AddAddress("jakrit000333@gmail.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>