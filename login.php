<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/log.css">
  </head>

  <body>
    <?php
      // Importowanie plików zawierających metody potrzebne do poprawnego działania dodawania nowych stron. 
      error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
      include './admin/admin.php';
      include './cfg.php';
      $con = new Config("localhost", "root", "", "moja_strona");
      $db = $con->connection(); $user = new Admin($db);
      $user->login("users");
   ?>

   <div class="pan-log">
      <form id="login" method="post">
        <label for="username">UserName:</label>
        <input id="username" type="text" name="username" class=""/>
        <label for="password">Password:</label>
        <input id="password" type="password" name="password" class="" />
        <div class="buttons">
          <input class="btn" id="submit" name="submit" type="submit" value="Zaloguj"/>
          <a href="index.php"><span id="btn2">Powrót</span></a>
          <a href="remindPassword.php"><span id="btn2">Przypomnij Hasło</span></a>
        </div>
       </form>
   </div>
  </body>
</html>
