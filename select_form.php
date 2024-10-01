<!DOCTYPE html>
<html>
    <head>
        <title>Forms</title>
        <meta charest="utf-8">
    </head>
    <body>
        <form action="process_form.php">

            <!-- <select name="marque">
                <option value="bmw">BMW</option>
                <option value="fmc">FORD</option>
                <option value="benz">BENZ</option>
            </select> -->

            <select name="cars">
                <optgroup label="Germany">
                    <option value="bmw">BMW</option>
                    <option value="audi">AUDI</option>
                    <option value="benz" selected>BENZ</option>
                </optgroup>
                <optgroup label="Japan">
                    <option value="toyota">TOYOTA</option>
                    <option value="honda">HONDA</option>
                    <option value="lexus">LEXUS</option>
                </optgroup>
            </select>

            <button>Send</button>

        </form>
    </body>

    <main>