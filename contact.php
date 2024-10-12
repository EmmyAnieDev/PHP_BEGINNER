<?php

require 'includes/init.php';

?>


<?php require 'includes/header.php' ?>

<h2>Contact</h2>

<form action="" method="post">

    <div class="form-group">
        <label for="email">Your email</label>
        <input class="form-control" name="email" id="email" type="email-local" placeholder="Your email">
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input class="form-control" name="subject" id="subject" placeholder="Subject">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
    </div>

    <button class="btn">Send</button>

</form>

<?php require 'includes/footer.php' ?>