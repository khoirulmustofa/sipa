
<!DOCTYPE html>
<html>

<head>
<title>Send Mail</title>
<!-- <script src="https://smtpjs.com/v3/smtp.js"></script> -->

<!-- <script type="text/javascript">
    function sendEmail() {
        Email.send({
            Host : "smtp.google.com",
            Username : "furizal1999@gmail.com",
            Password : "0910909109",
            // To : 'furizal1999@gmail.com',
            To : 'furizal@student.uir.ac.id',
            From : "furizal1999@gmail.com",
            Subject : "SIPA FT UIR",
            Body : "aSSALAMU'ALAIKUM"
        }).then(function(message){
                alert(message)
            }
        );
    }


</script> -->
</head>

<body>
<!-- <form method="post">
    <input type="button" value="Send Email"
        onclick="sendEmail()" />
</form> -->

<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'fakultas_teknik@uir.ac.id';                       // SMTP username
    $mail->Password   = 'uirunggul2020';                               // SMTP password
    $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('fakultas_teknik@uir.ac.id', 'FAKULTAS TEKNIK UIR');
    $mail->addAddress('nadiarozaan18@gmail.com', 'NADIA ROZAAN');     // Add a recipient


    // Attachments
    $mail->addAttachment('test.jpg', 'test.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

</body>

</html>
