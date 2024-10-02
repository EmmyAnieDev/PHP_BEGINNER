<?php require 'header.php'; ?>

<!-- Display errors if any -->
<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- Article Form -->
<form action="" method="post">
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" rows="4" cols="40" placeholder="Article content"><?= htmlspecialchars($content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input name="published_at" id="published_at" type="datetime-local" value="<?= htmlspecialchars($published_at); ?>">
    </div>



    <button type="submit">Save</button>
</form>