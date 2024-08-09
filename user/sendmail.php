<?php



require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
// require 'mail/src/OAuth.php';
require 'mail/src/SMTP.php';
require 'mail/src/POP3.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function send_mail($tieude, $maildathang, $noidung)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {

            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP(); // Sử dụng SMTP để gửi mail
            $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
            $mail->SMTPAuth = true; // Bật xác thực SMTP
            $mail->Username = 'luan21032004@gmail.com'; // Tài khoản email
            $mail->Password = 'gxyilfcpahqyyyrf'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
            $mail->SMTPSecure = 'tls'; // Mã hóa SSL
            $mail->Port = 587; // Cổng kết nối SMTP là 465

            //Recipients
            $mail->setFrom('luan21032004@gmail.com', 'Shop điện thoại LDMobile'); // Địa chỉ email và tên người gửi
            $mail->addCC('luan21032004@gmail.com');
            $mail->addAddress($maildathang, ''); // Địa chỉ mail và tên người nhận


            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $tieude; // Tiêu đề
            $mail->Body = $noidung; // Nội dung

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
