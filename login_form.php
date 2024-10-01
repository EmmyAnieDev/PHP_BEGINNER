<!DOCTYPE html>
<html>
    <head>
        <title>Forms</title>
        <meta charest="utf-8">
    </head>
    <body>
         <!-- Default method for sending with a form is "GET". this allow your data show in the url of the page
          action attribute. "POST" send data separetly from the query string  -->
        <form action="process_form.php", method="POST">

            <input name="username">

            <input name="password", type="password">

            <button>Login</button>

        </form>
    </body>

    <main>