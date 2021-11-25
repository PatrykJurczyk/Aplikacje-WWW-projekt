<?php
    function FormularzLogowania(){
        $wynik = '
        <div class="logowanie">
        <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER[REQUEST_URI].'">
                    <table class="logowanie">
                        <tr>
                            <td class="log4_t">[email]</td>
                            <td>
                                <input type="text" name="login_email" class="logowanie"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="log4_t">[haslo]</td>
                            <td>
                                <input type="password" name="login_pass" class="logowanie" />
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <input type="submit" name="x1_submit" class="logowanie" value="Zaloguj" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        ';

        return $wynik;
    }

    function ListaPodstron(){
        $query = "SELECT * FROM page_list WHERE id='$id_clear' ORDER BY data DESC LIMIT 100";
        $result = mysqli_query($query);

        while($row = mysqli_fetch_array($result)){
            $row['id'].' '.$row['tytul'].'<br/>';
        }
    }

    FormularzLogowania();
    // ListaPodstron();
?>