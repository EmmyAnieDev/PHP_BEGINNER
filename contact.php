<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'includes/init.php';

$email = $subject = $message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // deafult values as empty
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = [];

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
        echo '<p>Your message has been sent successfully!</p>';
    }
}

?>

<?php require 'includes/header.php' ?>

<h2>Contact</h2>

<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
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

<?php require 'includes/footer.php' ?>
