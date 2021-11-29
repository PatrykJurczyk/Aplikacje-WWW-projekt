<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/remindPass.css">
    <title>Przypomnij hasło</title>
</head>
<body>
    <?php
    // Klasa posiadająca metody odpowiedzialne za przypomnienie hasła.
    class PrzypomnijHaslo{ 
        private $db;

        function __construct($db) {
            $this->db = $db;
        }
        // Funkjcja odpowiedzialna za wysłanie email z hasłem.
        function PrzypomnijHaslo() {
            $errorMessage = null;
            $successMessage = null;

            $name = ($_POST['name']);
            $email = ($_POST['email']);

            if(empty($name) || empty($email)) {
                $errorMessage = '<div class="mess">Wypełnij wszystkie pola!</div>';
                echo $errorMessage;
            }
            if (is_null($errorMessage)) {
                $q = "SELECT * FROM `users` WHERE `username`='".$name."' LIMIT 1";
                $result = $this->db->query($q);
                while($obj = $result->fetch_object()){
                    if($obj->username == $name){
                        mail('twoj-adres@email.pl', 'Przypomnienie hasła: ', "Hasło: $obj->password", "From: $obj->username <$email>");
                        $successMessage = '<div class="mess">Wiadomość została wysłana</div>'; 
                    }
                }
            }
        }
    }

    // Do poprawnego wykorzystania meody potrzebne było połączenie się z bazą danych za pomocą metod napisanych w pliku cfg.php
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    include './cfg.php';
    include './admin/admin.php';
    $con = new Config("localhost", "root", "", "moja_strona");
    $db = $con->connection();
    $pass = new PrzypomnijHaslo($db);
    $pass->PrzypomnijHaslo();
    ?>
    <!-- Formularz zgłoszeniowy -->
    <section class='main-sec' style='padding-top: 120px;'>
        <div class='pan-log'>
            <h2 class='h2'>
                Przypomnij Hasło
            </h2> 
            <form id="login" method='POST'>
                <label for="username">UserName:</label>
                <input id="username" type="text" name="name" class=""/>

                <label for="email">Email:</label>
                <input id="email" type="email" name="email" class=""/>

                <div class='buttons'>
                    <input class='btn' id='submited' name='submited' type='submit' value='Wyślij przypomnienie'/>
                </div>
            </form> 
            <?php echo $successMessage; echo $errorMessage; ?>
        </div>
    </section>
</body>
</html>