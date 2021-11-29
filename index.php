<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="/aplikacje_www_projekt/css/style.css"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
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
        <li><a href="contact.php">Kontakt</a></li>
      </ul>
      <form name="form1" method="post">
        <a href="listSubpage.php" class="admin">Admin</a>
      </form>
    </section>

    <section class="t1 h2">
      <form method="POST" name="background">
        <input
          type="button"
          value="żółty"
          ONCLICK="changeBackground('#FFF000')"
        />
        <input
          type="button"
          value="czarny"
          ONCLICK="changeBackground('#000000')"
        />
        <input
          type="button"
          value="biały"
          ONCLICK="changeBackground('#FFFFFF')"
        />
        <input
          type="button"
          value="zielony"
          ONCLICK="changeBackground('#00FF00')"
        />
        <input
          type="button"
          value="niebieski"
          ONCLICK="changeBackground('#0000FF')"
        />
        <input
          type="button"
          value="pomarańczowy"
          ONCLICK="changeBackground('#FF8000')"
        />
        <input
          type="button"
          value="szary"
          ONCLICK="changeBackground('#c0c0c0')"
        />
        <input
          type="button"
          value="czerwony"
          ONCLICK="changeBackground('#FF0000')"
        />
        <input
          type="button"
          value="default"
          ONCLICK="changeBackground('url(/aplikacje_www_projekt/img/tlo.jpg)')"
        />
      </form>
    </section>

    <section>
      <div id="animacjaTestowa1" class="test-block">
        Kliknij, a się powiększe
      </div>
      <div id="animacjaTestowa2" class="test-block">
        Najedź kursorem, a się powiększe
      </div>
      <div id="animacjaTestowa3" class="test-block">Klikaj, abym urósł</div>
    </section>

    <?php
        // Importowanie plików zawierających metody potrzebne do poprawnego działania dodawania nowych stron. 
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        include './cfg.php';
        include './showpage.php';
        include './admin/admin.php';
        $con = new Config("localhost", "root", "", "moja_strona");
        $db = $con->connection(); $pokazstrone = new PokazStrone($db); $user =
    new Admin($db); $user->logout(); if($_GET['idp'] == '') $page =
    $pokazstrone->PokazPodstrone(1); if($_GET['idp'] == 'filmy') $page =
    $pokazstrone->PokazPodstrone(2); if($_GET['idp'] == 'pierwszy-lot') $page =
    $pokazstrone->PokazPodstrone(4); if($_GET['idp'] == 'rekordy') $page =
    $pokazstrone->PokazPodstrone(5); if($_GET['idp'] == 'uczestnicy') $page =
    $pokazstrone->PokazPodstrone(6); if($_GET['idp'] == 'kontakt') $page =
    $pokazstrone->PokazPodstrone(3); if (file_exists($page)) { include($page); }
    else { echo "$page"; } ?>

    <script src="/aplikacje_www_projekt/js/main.js"></script>
    <script
      src="/aplikacje_www_projekt/js/main1.js"
      type="text/javascript"
    ></script>
    <script
      src="/aplikacje_www_projekt/js/animacji.js"
      type="text/javascript"
    ></script>

    <section class="identyfikator">
      <?php

            $nr_indeksu = '159154';
            $nrGrupy = 'ISI4';
            echo "Patryk Jurczyk $nr_indeksu grupa $nrGrupy"; 

        ?>
    </section>
  </body>
</html>
