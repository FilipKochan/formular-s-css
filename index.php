<!doctype html>
<html>

<head>
    <title>Formular</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php
    $a = 5;
    $b = 7;

    function zvyraznenichyby(&$spravnyinput)
    {
        if ($spravnyinput == 1) {
            echo ' class="spravne" ';
        } elseif ($spravnyinput == 0) {
            echo ' class="chybne" ';
        }
    }

    $inputjmeno = 2;
    $inputemail = 2;
    $inputtelefon = 2;
    $inputvek = 2;
    $inputkontrola = 2;

    if (isset($_REQUEST["ODESLAT"]) && $_REQUEST["ODESLAT"] == "ODESLAT") {
        if (isset($_REQUEST["jmeno"]) && strlen($_REQUEST["jmeno"]) > 0) {
            $jmeno = $_REQUEST["jmeno"];
            if (strlen($jmeno) < 2) {
                //echo "Jmeno je moc kratke.";
                $inputjmeno = 0;
            }

            for ($i = 0; $i < strlen($jmeno); $i++) {
                if (!preg_match("/^[a-záčďéěíňóřšťúůýž]$/i", $jmeno[$i])) {
                    //print "Jmeno neobsahuje neplasdplatny znak na pozici " . ($i + 1) . ": " . $jmeno[$i];
                    $inputjmeno = 0;
                    break;
                }
            }
            if ($inputjmeno == 2)
                $inputjmeno = 1;
        } else {
            $inputjmeno = 0;
        }

        if (isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 0) {
            $inputemail = 1;
        } else {
            $inputemail = 0;
        }

        if (isset($_REQUEST["zprava"]) && strlen($_REQUEST["zprava"] > 0)) {
        } else {
            // echo "Zprava nebyla vyplnena!";
        }

        if (isset($_REQUEST["pohlavi"])) {
            // echo "Pohlavi: " . $_REQUEST["pohlavi"];
        } else {
            // echo "Pohlavi nebylo zadano!";
        }

        if (isset($_REQUEST["telcislo"]) && strlen($_REQUEST["telcislo"]) > 0) {
            $inputtelefon = 1;
        } else {
            $inputtelefon = 0;
        }

        if (isset($_REQUEST["vek"]) && strlen($_REQUEST["vek"]) > 0 && $_REQUEST["vek"] > 0 && $_REQUEST["vek"] < 150) {
            $inputvek = 1;
        } else {
            $inputvek = 0;
        }

        if (isset($_REQUEST["newsletter"])) {
            // echo "Zajem o newsletter: ANO";
        } else {
            //echo "Zajem o newsletter: NE";
        }

        if (isset($_REQUEST["kontrola"]) && strlen($_REQUEST["kontrola"]) > 0) {
            if ($_REQUEST["kontrola"] == $a + $b) {
                $inputkontrola = 1;
            } else {
                $inputkontrola = 0;
            }
        } else {
            $inputkontrola = 0;
            //echo "Kontrola nebyla vyplnena!";
        }
    }
    ?>
    <div class="container">
        <form action="index.php" method="get">
            <label for="jmeno">Jmeno:</label><br>
            <input <?php zvyraznenichyby($inputjmeno) ?> type="text" id="jmeno" name="jmeno"
                <?php if (isset($_REQUEST["jmeno"])) echo 'value="' . $_REQUEST["jmeno"] . '"' ?>> <br>

            <label for="email">E-mail:</label><br>
            <input <?php zvyraznenichyby($inputemail) ?> type="email" id="email" name="email"
                <?php if (isset($_REQUEST["email"])) echo 'value="' . $_REQUEST["email"] . '"' ?>> <br>

            <label for="zprava">Zprava:</label><br>
            <textarea id="zprava"
                name="zprava"><?php if (isset($_REQUEST["zprava"]) && strlen($_REQUEST["zprava"]) > 0) echo $_REQUEST["zprava"] ?></textarea><br>

            <fieldset>
                <legend>Vyberte sve pohlavi</legend>
                <input type="radio" id="muz" name="pohlavi" value="muz"
                    <?php if (isset($_REQUEST["pohlavi"]) && $_REQUEST["pohlavi"] == "muz") echo 'checked' ?>>
                <label for="muz">Muz</label><br>
                <input type="radio" id="zena" name="pohlavi" value="zena"
                    <?php if (isset($_REQUEST["pohlavi"]) && $_REQUEST["pohlavi"] == "zena") echo 'checked' ?>>
                <label for="zena">Zena</label>
            </fieldset>


            <label for="telcislo">Zadejte prosim telefonni cislo:</label><br>
            <input <?php zvyraznenichyby($inputtelefon) ?> type="tel" id="telcislo" name="telcislo"
                placeholder="+420 777 666 555" pattern="^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$"
                <?php if (isset($_REQUEST["telcislo"])) echo 'value="' . $_REQUEST["telcislo"] . '"' ?>><br>

            <label for="vek">Zadejte prosim svuj vek:</label><br>
            <input <?php zvyraznenichyby($inputvek) ?> type="text" id="vek" name="vek" pattern="[0-9]{1,3}"
                <?php if (isset($_REQUEST["vek"])) echo 'value="' . $_REQUEST["vek"] . '"' ?>><br>

            <label for="kontrola">Kolik je <?php echo $a . " + " . $b ?> ?<br></label>
            <input <?php zvyraznenichyby($inputkontrola) ?> type="text" id="kontrola" name="kontrola"
                <?php if (isset($_REQUEST["kontrola"]) && is_numeric($_REQUEST["kontrola"]) && $_REQUEST["kontrola"] == $a + $b) echo 'value="' . $_REQUEST["kontrola"] . '"' ?>><br>
            <input type="checkbox" id="newsletter" name="newsletter" value="ano"
                <?php if (isset($_REQUEST["newsletter"])) echo 'checked="checked"' ?>>
            <label for="newsletter">Mam zajem o zasilani newsletteru.</label><br>
            <input type="submit" name="ODESLAT" value="ODESLAT">
        </form>
    </div>
</body>

</html>