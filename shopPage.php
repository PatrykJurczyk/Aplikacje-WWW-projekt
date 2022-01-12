<html>
   
   <head>
      <title>Panel Admina</title>
      <link rel="stylesheet" href="./css/shopPage.css">
      <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
   </head>
   
   <body>
      <div class="shopPanel">
         <form name="form2" method="post">
             <input class="btn" name="submit2" type="submit" id="submit2" value="Wyloguj">
             <input class="btn" name="submit6" type="submit" id="submit6" value="Powrót">
             <div class="btnShop">
                 <input class="btn1" name="submit7" type="button" id="submit7" value="Dodaj Kategorię">
                 <input class="btn1" name="submit11" type="button" id="submit11" value="Usuń Kategorie">
                 <input class="btn1" name="submit12" type="button" id="submit12" value="Edytuj Kategorie">
                 <input class="btn1" name="submit13" type="button" id="submit13" value="Pokaż Kategorie">
             </div>
         </form>
      </div>
      <div class="elemet-rendered">
          <img src="./img/smiley.png" alt="smile" style="width: 600px; display:block; margin: auto;">
      </div>
      <?php
         // Importowanie plików zawierających metody potrzebne do poprawnego działania dodawania nowych stron. 
         error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
         include 'session.php';
         include 'admin/admin.php';
         include 'cfg.php';
         $con = new Config("localhost", "root", "", "moja_strona");
         $db = $con->connection();
         $user = new Admin($db);
         $user->logout();
         $user->powrotDoPanelAdmin();
      ?>

      <script type="text/JavaScript">
          const elRendered = document.querySelector('.elemet-rendered');
          const btn13 = document.querySelector('#submit13');
          const btn12 = document.querySelector('#submit12');
          const btn11 = document.querySelector('#submit11');
          const btn7 = document.querySelector('#submit7');
          btn13.onclick = function() { // Pokaż Drzewo
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `<?php $user->pokazDrzewo(); ?>`
          }
          btn12.onclick = function() { // Edytuj Kategorie
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `<?php $user->edytujKategorie(); ?>`
          }
          btn11.onclick = function() { // Usuń Kategorie
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `<?php $user->usunKategorie(); ?>`
          }
          btn7.onclick = function() { // Dodaj Kategorie
            elRendered.innerHTML = ""
            elRendered.innerHTML =  `<?php $user->dodajKategorie(); ?>`
          }
      </script>
   </body>
</html>