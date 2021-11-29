<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="/aplikacje_www_projekt/css/constact.css"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <title>Formularz kontaktowy</title>
  </head>
  <body>
    <?php
        // Clasa zawierająca metody odpowiedzialne za wysyłanie zgłoszeń na email
        class Contact{
            // Funkcja wyświetlająca szkielet formularza zgłoszeniowego
            function PokazKontakt($m){
                echo "
                    <section class='main-sec' style='padding-top: 120px;'>
                        <div class='form'>
                            <h2 class='h2'>
                                Formularz kontaktowy
                            </h2>
                            <form method='POST'>
                                <div class='item'>
                                    <input type='text' name='temat' class='' placeholder='Podaj temat'>
                                </div>
                                <div class='item'>
                                    <textarea id='Rodzaj' name='tresc' rows='3' cols='' placeholder='Zapytaj o co chcesz' class=''></textarea> 
                                </div>
                                <div class='item'>
                                    <input type='email' name='email' class='' placeholder='Podaj E-mail'>
                                </div>
                                <div class='buttons'>
                                    <input class='btn' id='submite' name='submite' type='submit' value='Wyślij zgłoszenie'/>
                                </div>
                            </form>        
                        </div>
                        $m
                    </section>
                ";
            }

            // Metoda odpowiedziana za mechanike i poprawność wysłania email 
            function WyslijMailKontakt($odbiorca){
                if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
                    $message1 = '<div class="err">Wypełnij wszystkie pola!</div>';
                    $test = new Contact;
                    $test->PokazKontakt($message1);
                } else{
                    $mail['subject'] = $_POST['temat'];
                    $mail['body'] = $_POST['tresc'];
                    $mail['sender'] = $_POST['email'];
                    $mail['reciptient'] = $odbiorca;
                    
                    $header = "From: Formularz kontaktowy <".$mail['sender'].">\n";
                    $header .= "MIME-Version: 1.0";
                    $header .= "Content-Type: text/plain; charset=utef-8";
                    $header .= "Content-Transfer-Encoding:";
                    $header .= "X-Sender: <".$mail['sender'].">\n";
                    $header .= "X-Mailer: PRapWWW mail 1.2\n";
                    $header .= "X-Priority: 3\n";
                    $header .= "Return-Path: <".$mail['sender'].">\n";
    
                    mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
                    $message1 = '<div class="err">Wiadomosc została wyslana</div>';
                    $test = new Contact;
                    $test->PokazKontakt($message1);
                }
            }
        }
        $send = new Contact();
        $send->WyslijMailKontakt('YourEmailc@gmail.com');
    ?>
  </body>
</html>
