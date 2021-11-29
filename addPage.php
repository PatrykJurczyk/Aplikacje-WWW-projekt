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
         error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
         include 'session.php';
         include 'admin/admin.php';
         include 'cfg.php';
         $con = new Config("localhost", "root", "", "moja_strona");
         $db = $con->connection();
         $user = new Admin($db);
         $user->EdytujPodstrone();
         $user->DodajPodstrone();
         $user->UsunPodstrone();
         $user->logout();
         $user->powrotDoListPods();
      ?>

      <div class='panel-manage'>
         <h2>Zarządzaj Podstroną</h2><br>
         <form id='editpage' method = 'post'>
            <div>
               <label for='idstrony'>ID</label>
               <input value='' class='email' id='idstrony' type = 'text' name = 'idstrony'/>
            </div>
            <div>
               <label for='title'>Title</label>  
               <input value='' class='email' id='title' type = 'text' name = 'title'/>
            </div>
            <div>
               <label for='content'>Content</label>
               <textarea class='email' id='content' name='content' placeholder='' style='height:200px'></textarea>
            </div>
            <div>
               <label for='status'>Status</label>
               <input class='email' value='' id='status' type = 'text' name = 'status'/>
            </div>
            <div class='btn' >
              <input style='width: 100%;' class='email' id='submit4' name='submit4' type = 'submit' value = 'Dodaj stronę'/>
            </div>
         </form>
      </div>
   </body>
</html>