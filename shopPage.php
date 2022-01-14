<html>
   <head>
      <title>Panel Admina</title>
      <link rel="stylesheet" href="./css/categoryPage.css">
      <link rel="stylesheet" href="./css/shopPage.css">
      <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"/>
   </head>
   <body>
      <div class="shopPanel">
         <form name="form2" method="post">
             <input class="btn" name="submit19" type="submit" id="submit19" value="Powrót">
             <div class="btnShop">
                 <input class="btn1" name="submit15" type="button" id="submit15" value="Dodaj Produkt">
                 <input class="btn1" name="submit16" type="button" id="submit16" value="Usuń Produkt">
                 <input class="btn1" name="submit17" type="button" id="submit17" value="Edytuj Produkt">
                 <input class="btn1" name="submit18" type="button" id="submit18" value="Pokaż Produkt">
             </div>
         </form>
      </div>
      <div class="elemet-rendered">
          <img src="./img/smiley.png" alt="smile" style="width: 600px; display:block; margin: auto;">
      </div>
      <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        include 'session.php';
        include 'admin/admin.php';
        include 'cfg.php';
        $con = new Config("localhost", "root", "", "moja_strona");
        $db = $con->connection();
        $user = new Admin($db);
        $user->powrotDoPanelKategorii();
        $user->DodajProdukt();
        $user->UsunProdukt();
        $user->EdytujProdukt();
      ?>


    <script type="text/JavaScript">
        const elRendered = document.querySelector('.elemet-rendered');
        const btn15 = document.querySelector('#submit15');
        const btn16 = document.querySelector('#submit16');
        const btn17 = document.querySelector('#submit17');
        const btn18 = document.querySelector('#submit18');

        btn15.onclick = function() { // Dodaj Produkt
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `
            <?php 
                $user->wyswietlDodajProdukt();
            ?>`
        }
        btn16.onclick = function() { // Usuń Produkt
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `
            <?php 
                $user->wyswietlUsunProdukt();
            ?>
            `
        }
        btn17.onclick = function() { // Edytuj Produkt
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `
            <?php 
                $user->wyswietlEdytujProdukt();
            ?>
            `
        }
        btn18.onclick = function() { // Pokaż Produkt
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `
            <?php 
                $user->pokazProdukt();
            ?>
            `
        }
    </script>
   </body>
</html>