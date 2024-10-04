<?php

// This function automatically loads the required class file when a class is used.
// The function takes the class name as input and constructs the file path based on the class name.
// It looks for the class files in the 'classes' directory, relative to the current file's directory (__DIR__).
// This removes the need to manually include class files throughout the codebase.
spl_autoload_register(function($class){
    require __DIR__ . "/../classes/{$class}.php";
});

// Start a new session or resume the existing session.
// This is necessary for storing user data (like login state) across different pages.
session_start(); 
