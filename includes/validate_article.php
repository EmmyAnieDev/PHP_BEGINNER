<?php


// function to Validate input
function validateArticle($title, $content, $published_at){

    $errors = [];

    if ($title == '') {
        $errors[] = 'Title is required';
    }
    if ($content == '') {
        $errors[] = 'Content is required';
    }
    if ($published_at == '') {
        $errors[] = 'Publication date is required';
    }

    return $errors;

}