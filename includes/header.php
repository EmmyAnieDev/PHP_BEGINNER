<!DOCTYPE html>
<html>
    <head>
        <title>My Blog</title>
        <meta charest="utf-8">
    </head>
    <body>
        <header?>
            <h1>My Blog</h1>
        </header>

        <nav>
            <ul>
                <li><a href="/php_udemy/">   Home</a></li>
                <?php if (Auth::isLoggedIn()) : ?>

                <li><a href="/php_udemy/admin/">   Admin</a></li>
                <li><a href="/php_udemy/auth/logout.php">   Logout</a></li>

                <?php else: ?>   

                <li><a href="/php_udemy/auth/login.php">   Login</a></li>

                <?php endif; ?>  
            </ul>
        </nav>
    </body>

    <main>