<?php require '../includes/header.php'; ?>

<!-- Display errors if any -->
<?php if (!empty($article_obj->errors)) : ?>
    <ul>
        <?php foreach($article_obj->errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<!-- Article Form -->
<form id="formArticle" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($title); ?>">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" rows="4" cols="40" placeholder="Article content"><?= htmlspecialchars($content); ?></textarea>
    </div>

    <div class="form-group">
        <label for="published_at">Publication date and time</label>
        <input class="form-control" name="published_at" id="published_at" type="datetime-local" value="<?= htmlspecialchars($published_at); ?>">
    </div>

    <fieldset>

        <legend> Categories </legend>

        <?php foreach ($categories as $category) : ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category['id'] ?>" id="category<?= $category['id'] ?>"
                    <?php if (in_array($category['id'], $category_ids)) : ?>checked<?php endif; ?>>
                <label class="form-check-label" for="category<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach; ?>

    </fieldset>


    <button type="submit">Save</button>
</form>