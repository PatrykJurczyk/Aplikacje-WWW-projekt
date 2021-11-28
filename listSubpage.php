<html>
   <head>
      <title>Panel Admina - Lista Podstron</title>
      <link rel="stylesheet" href="./css/subpage.css">

   </head>

   <body>
      <div class="box">
         <h2>Lista Podstron</h2>
         <?php
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            include './session.php';
            include './admin/admin.php';
            include './cfg.php';
            $con = new Config("localhost", "root", "", "moja_strona");
            $db = $con->connection();
            $user = new Admin($db);
            $user->logout();
            $user->powrotDoProjektu();
            $user->ListaPodstron();
            $user->WywolajEdit();
            $user->dodajnowabutton();
         ?>
         <div class="adminPanel">
            <form name="form2" method="post">
               <input class="btn bt" name="submit10" type="submit" id="submit10" value="Dodaj Podstronę">
               <input class="btn pos" name="submit2" type="submit" id="submit2" value="Wyloguj">
               <input class="btn bt" name="submit9" type="submit" id="submit9" value="Powrót">
            </form>
         </div>   
      </div>
   </body>
</html>