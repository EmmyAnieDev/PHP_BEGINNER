<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/init.php';

$email = $subject = $message = '';
$sent = false;
$errors = []; // Ensure errors array is initialized

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Default values as empty
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email address.';
    }

    // Validate subject
    if ($subject === '') {
        $errors[] = 'Please enter a subject.';
    }

    // Validate message
    if ($message === '') {
        $errors[] = 'Please enter a message.';
    }

    // If no errors, handle the form (e.g., send email)
    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';          // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                       // Enable SMTP authentication
            $mail->Username   = 'example@gmail.com';                 // SMTP username
            $mail->Password   = '1234567890';                 // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = 587;                        // TCP port to connect to

            // Recipients
            $mail->setFrom('example@gmail.com', 'Test');
            $mail->addAddress($email);                     // Add a recipient
            $mail->addReplyTo('example@gmail.com'); 

            // Content
            $mail->Subject = htmlspecialchars($subject);
            $mail->Body    = htmlspecialchars($message);

            $mail->send();
            $sent = true; // Set sent to true after sending the email
            
        } catch (Exception $e) {
            $errors[] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo; // Log error message
        }
    }
}

?>

<?php require 'includes/header.php' ?>

<h2>Contact</h2>

<?php if ($sent) : ?>
    <p>Message sent.</p>
<?php else : ?>
    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= htmlspecialchars($error) ?></li> <!-- Ensure error messages are escaped -->
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="post" id="formContact">
        <div class="form-group">
            <label for="email">Your email</label>
            <input class="form-control" name="email" id="email" type="email" placeholder="Your email"
                value="<?= htmlspecialchars($email) ?>">
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input class="form-control" name="subject" id="subject" placeholder="Subject"
                value="<?= htmlspecialchars($subject) ?>">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" placeholder="Message"><?= htmlspecialchars($message) ?></textarea>
        </div>

        <button class="btn">Send</button>
    </form>

<?php endif; ?>

<?php require 'includes/footer.php' ?>
