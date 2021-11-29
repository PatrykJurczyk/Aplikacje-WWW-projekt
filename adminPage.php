<html>
   
   <head>
      <title>Panel Admina</title>
      <link rel="stylesheet" href="./css/manpage.css">
   </head>
   
   <body>
      <div class="adminPanel">
         <form name="form2" method="post">
            <input class="btn" name="submit2" type="submit" id="submit2" value="Wyloguj">
            <input class="btn" name="submit8" type="submit" id="submit8" value="Powrót">
         </form>
      </div>

      <?php
         // Importowanie plików zawierających metody potrzebne do poprawnego działania dodawania nowych stron. 
         error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
         include './session.php';
         include './admin/admin.php';
         include './cfg.php';
         $con = new Config("localhost", "root", "", "moja_strona");
         $db = $con->connection();
         $user = new Admin($db);
         $user->EdytujPodstrone();
         $user->DodajPodstrone();
         $user->UsunPodstrone();
         $user->logout();
         $user->powrotDoListPods();
         $user->PobierzDaneStrony($_GET['idstrony']);
      ?>
   </body>
</html>