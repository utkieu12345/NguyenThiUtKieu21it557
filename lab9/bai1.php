<?php
require "../git_clone/PHPMailer/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
require "../git_clone/PHPMailer/src/SMTP.php"; //nhúng thư viện vào để dùng
require '../git_clone/PHPMailer/src/Exception.php'; //nhúng thư viện vào để dùng

//      //true: enables exceptions
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;
try {
    $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
    $mail->isSMTP();
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $nguoigui = 'uyenuyen100103@gmail.com';
    $matkhau = 'qzkhsmtsosrupsku'; // mật khẩu ứng dụng đã tạo ở bước 3
    $tennguoigui = 'UYên';
    $mail->Username = $nguoigui; // SMTP username
    $mail->Password = $matkhau;   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom($nguoigui, $tennguoigui);
    $to = "levantruyen57@gmail.com";
    $to_name = "truyền";

    $mail->addAddress($to, $to_name); //mail và tên người nhận
    // $mail->addAddress("nlquan@vku.udn.vn","lequan");
    /* $recipients = "test1@test.com,test2@test.com,test3@test.com,test1@test.com";
$email_array = explode(",",$recipients);*/
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Gửi thư từ php';
    $noidungthu = "<b>Chào bạn!</b><br>Chúc an lành!";
    $mail->Body = $noidungthu;
    $mail->AddAttachment("abc.jpg", "picture");
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));
    $mail->send();
    echo 'Đã gửi mail xong';
} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
