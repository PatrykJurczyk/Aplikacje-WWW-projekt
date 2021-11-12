<?php

    include('./cfg.php');
    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aplikacje_www_projekt/css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Historia lotów kosmicznych</title>
</head>
<body onload="startclock()">
    <section class="menu">
        <ul>
            <li class="time">
                <div id="zegarek"></div>
                <div id="data"></div>
            </li>
            <li><a href="index.php?idp=">Strona główna</a></li>
            <li><a href="index.php?idp=filmy">Filmy</a></li>
            <li><a href="index.php?idp=pierwszy-lot">Pierwszy lot</a></li>
            <li><a href="index.php?idp=rekordy">Rekordy</a></li>
            <li><a href="index.php?idp=uczestnicy">Uczestnicy</a></li>
            <li><a href="index.php?idp=kontakt">Kontakt</a></li>
        </ul>
    </section>

    <section class="t1 h2">
        <FORM METHOD="POST" NAME="background">
            <INPUT TYPE="button" VALUE="żółty" ONCLICK="changeBackground('#FFF000')">
            <INPUT TYPE="button" VALUE="czarny" ONCLICK="changeBackground('#000000')">
            <INPUT TYPE="button" VALUE="biały" ONCLICK="changeBackground('#FFFFFF')">
            <INPUT TYPE="button" VALUE="zielony" ONCLICK="changeBackground('#00FF00')">
            <INPUT TYPE="button" VALUE="niebieski" ONCLICK="changeBackground('#0000FF')">
            <INPUT TYPE="button" VALUE="pomarańczowy" ONCLICK="changeBackground('#FF8000')">
            <INPUT TYPE="button" VALUE="szary" ONCLICK="changeBackground('#c0c0c0')">
            <INPUT TYPE="button" VALUE="czerwony" ONCLICK="changeBackground('#FF0000')">
            <INPUT TYPE="button" VALUE="default" ONCLICK="changeBackground('url(/aplikacje_www_projekt/img/tlo.jpg)')">
        </FORM>
    </section>

    <section >
        <div id="animacjaTestowa1" class="test-block">Kliknij, a się powiększe</div>
        <div id="animacjaTestowa2" class="test-block">Najedź kursorem, a się powiększe</div>
        <div id="animacjaTestowa3" class="test-block">Klikaj, abym urósł</div>
    </section>

    <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

        /* po tym komentarzu będzie kod do dynamicznego ładowania stron */
        
        if($_GET['idp'] == '') $strona = './html/glowna.html';
        if($_GET['idp'] == 'pierwszy-lot') $strona = './html/pierwszy-lot.html';
        if($_GET['idp'] == 'rekordy') $strona = './html/rekordy.html';
        if($_GET['idp'] == 'uczestnicy') $strona = './html/uczestnicy.html';
        if($_GET['idp'] == 'kontakt') $strona = './html/kontakt.html';
        if($_GET['idp'] == 'filmy') $strona = './html/filmy.html';
    ?>

    <?php 

    if(file_exists($strona)){
        include($strona);
    } else{
        echo "The file $filename does not exist";
    }
    
    ?>

    <script src="/aplikacje_www_projekt/js/main.js"></script>
    <script src="/aplikacje_www_projekt/js/main1.js" type="text/javascript"></script>
    <script src="/aplikacje_www_projekt/js/animacji.js" type="text/javascript"></script>
    
    <section class="identyfikator">
        <?php

            $nr_indeksu = '159154';
            $nrGrupy = 'ISI4';
            echo "Patryk Jurczyk $nr_indeksu grupa $nrGrupy"; 

        ?>
    </section>

</body>
</html>
