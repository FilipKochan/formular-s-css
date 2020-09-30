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
            return " class=\"spravne\" ";
        } elseif ($spravnyinput == 0) {
            return " class=\"chybne\" ";
        }
    }

    $inputjmeno = 2;
    $inputemail = 2;
    $inputtelefon = 2;
    $inputvek = 2;
    $inputkontrola = 2;

    if (isset($_REQUEST["ODESLAT"]) && $_REQUEST["ODESLAT"] == "ODESLAT") {
        $polechyb = array();
        if (isset($_REQUEST["jmeno"]) && strlen($_REQUEST["jmeno"]) > 0) {
            $jmeno = $_REQUEST["jmeno"];
            if (strlen($jmeno) < 2) {
                //echo "Jmeno je moc kratke.";
                $polechyb["jmeno"] = "Jmeno je moc kratke.";
                $inputjmeno = 0;
            } else {
                for ($i = 0; $i < strlen($jmeno); $i++) {
                    if (!preg_match("/^[a-záčďéěíňóřšťúůýž]$/i", $jmeno[$i])) {
                        //print "Jmeno neobsahuje neplasdplatny znak na pozici " . ($i + 1) . ": " . $jmeno[$i];
                        $polechyb["jmeno"] = "Jmeno neobsahuje neplasdplatny znak na pozici " . ($i + 1) . ": " . $jmeno[$i];
                        $inputjmeno = 0;
                        break;
                    }
                }
            }
            if ($inputjmeno == 2) {
                $inputjmeno = 1;
                $polechyb["jmeno"] = "Jmeno je OK";
            }
        } else {
            $polechyb["jmeno"] = "Jmeno nebylo vyplneno.";
            $inputjmeno = 0;
        }

        if (isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 0) {
            $inputemail = 1;
            $polechyb["email"] = "Email je OK";
        } else {
            $inputemail = 0;
            $polechyb["email"] = "Email nebyl vyplnen.";
        }

        if (isset($_REQUEST["zprava"]) && strlen($_REQUEST["zprava"]) > 0) {
            $polechyb["zprava"] = "Zprava je OK.";
        } else {
            $polechyb["zprava"] = "Zprava nebyla vyplnena.";
        }

        if (isset($_REQUEST["pohlavi"])) {
            $inputpohlavi = 1;
            $polechyb["pohlavi"] = "Pohlavi je OK.";
        } else {
            $polechyb["pohlavi"] = "Pohlavi nebylo vyplneno.";
            $inputpohlavi = 0;
        }

        if (isset($_REQUEST["telcislo"]) && strlen($_REQUEST["telcislo"]) > 0) {
            $inputtelefon = 1;
            $polechyb["telcislo"] = "Telefonni cislo je OK.";
        } else {
            $inputtelefon = 0;
            $polechyb["telcislo"] = "Telefonni cislo neni vyplneno.";
        }

        if (isset($_REQUEST["vek"]) && strlen($_REQUEST["vek"]) > 0) {
            if ($_REQUEST["vek"] > 0 && $_REQUEST["vek"] < 150) {
                $inputvek = 1;
                $polechyb["vek"] = "Vek je OK";
            } else {
                $inputvek = 0;
                $polechyb["vek"] = "Zadan neplatny vek!";
            }
        } else {
            $inputvek = 0;
            $polechyb["vek"] = "Vek nebyl vyplnen.";
        }

        if (isset($_REQUEST["newsletter"])) {
            $polechyb["newsletter"] = "Zajem o newsletter: ANO";
        } else {
            $polechyb["newsletter"] = "Zajem o newsletter: NE";
        }

        if (isset($_REQUEST["kontrola"]) && strlen($_REQUEST["kontrola"]) > 0) {
            if ($_REQUEST["kontrola"] == $a + $b) {
                $inputkontrola = 1;
                $polechyb["kontrola"] = "Kontrola je OK.";
            } else {
                $inputkontrola = 0;
                $polechyb["kontrola"] = "Kontrola vyplnena chybne.";
            }
        } else {
            $inputkontrola = 0;
            $polechyb["kontrola"] = "Kontrola nebyla vyplnena!";
        }
    }
    ?>
    <div class="container">
        <form action="index.php" method="get">
            <label for="jmeno">Jmeno:
                <?php if (isset($polechyb["jmeno"])) print("<small " . zvyraznenichyby($inputjmeno) . ">" . $polechyb["jmeno"] . "</small>"); ?></label>

            <input <?php echo zvyraznenichyby($inputjmeno) ?> type="text" id="jmeno" name="jmeno"
                <?php if (isset($_REQUEST["jmeno"])) echo 'value="' . $_REQUEST["jmeno"] . '"' ?>> <br>

            <label for="email">E-mail:
                <?php if (isset($polechyb["email"])) print("<small " . zvyraznenichyby($inputemail) . ">" . $polechyb["email"] . "</small>"); ?></label>
            </label><br>
            <input <?php echo zvyraznenichyby($inputemail) ?> type="email" id="email" name="email"
                <?php if (isset($_REQUEST["email"])) echo 'value="' . $_REQUEST["email"] . '"' ?>> <br>

            <label for="zprava">Zprava: <small>(nepovinne)
                    <?php if (isset($polechyb["zprava"])) echo ($polechyb["zprava"]) ?></small></label><br>
            <textarea id="zprava"
                name="zprava"><?php if (isset($_REQUEST["zprava"]) && strlen($_REQUEST["zprava"]) > 0) echo $_REQUEST["zprava"] ?></textarea><br>

            <fieldset style="border-radius: 4px" <?php if (isset($_REQUEST["pohlavi"]))
                                                        print("class=\"spravne\"");
                                                    elseif (isset($_REQUEST["ODESLAT"])) print("class=\"chybne\"") ?>>
                <legend>Vyberte sve pohlavi
                    <?php if (isset($polechyb["pohlavi"])) print("<small " . zvyraznenichyby($inputpohlavi) . ">" . $polechyb["pohlavi"] . "</small>"); ?>
                </legend>
                <input type="radio" id="muz" name="pohlavi" value="muz"
                    <?php if (isset($_REQUEST["pohlavi"]) && $_REQUEST["pohlavi"] == "muz") echo 'checked' ?>>
                <label for="muz">Muz</label><br>
                <input type="radio" id="zena" name="pohlavi" value="zena"
                    <?php if (isset($_REQUEST["pohlavi"]) && $_REQUEST["pohlavi"] == "zena") echo 'checked' ?>>
                <label for="zena">Zena</label>
            </fieldset>


            <label for="telcislo">Zadejte prosim telefonni cislo:
                <?php if (isset($polechyb["telcislo"])) print("<small " . zvyraznenichyby($inputtelefon) . ">" . $polechyb["telcislo"] . "</small>"); ?></label><br>
            <input <?php echo zvyraznenichyby($inputtelefon) ?> type="tel" id="telcislo" name="telcislo"
                placeholder="+420 777 666 555" pattern="^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$"
                <?php if (isset($_REQUEST["telcislo"])) echo 'value="' . $_REQUEST["telcislo"] . '"' ?>><br>

            <label for="vek">Zadejte prosim svuj vek:
                <?php if (isset($polechyb["vek"])) print("<small " . zvyraznenichyby($inputvek) . ">" . $polechyb["vek"] . "</small>"); ?></label><br>
            <input <?php echo zvyraznenichyby($inputvek) ?> type="text" id="vek" name="vek" pattern="[0-9]{1,3}"
                <?php if (isset($_REQUEST["vek"])) echo 'value="' . $_REQUEST["vek"] . '"' ?>><br>

            <label for="kontrola">Kolik je <?php echo $a . " plus " . $b ?> ?
                <?php if (isset($polechyb["kontrola"])) print("<small " . zvyraznenichyby($inputkontrola) . ">" . $polechyb["kontrola"] . "</small>"); ?><br></label>
            <input <?php echo zvyraznenichyby($inputkontrola) ?> type="text" id="kontrola" name="kontrola"
                <?php if (isset($_REQUEST["kontrola"]) && is_numeric($_REQUEST["kontrola"]) && $_REQUEST["kontrola"] == $a + $b) echo 'value="' . $_REQUEST["kontrola"] . '"' ?>><br>
            <input type="checkbox" id="newsletter" name="newsletter" value="ano"
                <?php if (isset($_REQUEST["newsletter"])) echo 'checked="checked"' ?>>


            <label for="newsletter">Mam zajem o newsletter. <small>(nepovinne)</small><small>
                    <?php if (isset($polechyb["newsletter"])) echo $polechyb["newsletter"]; ?></small></label><br>
            <input type="submit" name="ODESLAT" value="ODESLAT">
        </form>

        <?php //print_r($polechyb); 
        ?>
    </div>
</body>

</html>