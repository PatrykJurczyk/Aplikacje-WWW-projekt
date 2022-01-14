<?php
    class Admin{
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        // Funkcja odpowiedzialna za logowanie się do panelu admina
        function login() {
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $myusername = mysqli_real_escape_string($this->db,$_POST['username']);
                $mypassword = mysqli_real_escape_string($this->db,$_POST['password']); 
                $q = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
                $result = $this->db->query($q);
                $count = mysqli_num_rows($result);
                if($count == 1) {
                    $_SESSION['login_user'] = $myusername;
                    header("location: listSubpage.php");
                }else {
                    $error = "Your Login Name or Password is invalid";
                    echo $error;
                }
            }
        }
        // Funkcja odpowiedzialna za wylogowywanie się z panelu admina
        function logout() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit2'])) {
                if(session_destroy()) {
                    header("Location: login.php");
                }
            }
        }
        // Funkcja odpowiedzialna za powrót do listy podsron
        function powrotDoListPods() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit8'])) {
                header("Location: listSubpage.php");
            }
        }
        // Funkcja odpowiedzialna za wracanie do podstron z formularza logowania
        function powrotDoProjektu() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit9'])) {
                header("Location: index.php?idp=/");
            }
        }
        // Funkcja odpowiedzialna za dodawanie funkcjonalnosci przycicku odpoweidzialnego za dodawninie nowych podstron
        function dodajnowabutton() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit10'])) {
                header("Location: addPage.php");
            }
        }
        // Funkcja odpowiedzialna za wyświetlanei podstron
        function ListaPodstron() {
            $query = "SELECT id, page_title, status FROM page_list ORDER BY id LIMIT 100";
            $result = $this->db->query($query);
            echo "<table>
                    <tr>
                    <th>ID</th>
                    <th>Page Title</th>
                    <th>Status</th>
                    <th>Edytuj</th>
                    </tr>";

            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['page_title'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td><form action='' method='POST'><input type='hidden' name='tempId' value='".$row["id"]."'/><input type='submit' name='submit-btn' class='btn-edit' value='Edytuj' /></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        // Funkcja odpowiedzialna za pobieranie danych zawartych na stronie jak i ważnych atrybnutów strony
        function PobierzDaneStrony($id) {
            $escapedid = mysqli_real_escape_string($this->db, $id);
            $query = "SELECT id, page_title, page_content, status FROM page_list WHERE id = $escapedid LIMIT 1";
            $result = $this->db->query($query);
            $row = mysqli_fetch_array($result);
            echo "
            <div class='panel-manage'>
                <h2>Zarządzaj Podstroną</h2><br>
                <form id='editpage' method = 'post'>
                    <div>
                        <label for='idstrony'>ID</label>
                        <input value='".$row['id']."' class='email' id='idstrony' type = 'text' name = 'idstrony'/>
                    </div>
                    <div>
                        <label for='title'>Title</label>  
                        <input value='".$row['page_title']."' class='email' id='title' type = 'text' name = 'title'/>
                    </div>
                    <div>
                        <label for='content'>Content</label>
                        <textarea class='email' id='content' name='content' placeholder='".$row['page_content']."' style='height:200px'></textarea>
                    </div>
                    <div>
                        <label for='status'>Status</label>
                        <input class='email' value='".$row['status']."' id='status' type = 'text' name = 'status'/>
                    </div>
                    <div class='btn'>
                        <input class='email' id='submit3' name='submit3' type = 'submit' value = 'Edytuj '/>
                        <input class='email' id='delete1' name='delete1' type = 'submit' value = 'Usuń Stronę '/>
                    </div>
                </form>
            </div>
            ";
        }
        // Funkcja odpowiedzialna za dodawanie funkcjonalnosci przycicku odpoweidzialnego za edytowanie wartości na stronie
        function WywolajEdit() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tempId'])) {
                echo $_POST['tempId'];
                header("Location: adminPage.php?idstrony=".$_POST['tempId']);
            }
        }
        // Funkcja odpowiedzialna za edytowanie wartości na stronie
        function EdytujPodstrone() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit3'])) {
                $escapedtitle = mysqli_real_escape_string($this->db,$_POST['title']);
                $escapedcontent = mysqli_real_escape_string($this->db,$_POST['content']); 
                $escapedid = mysqli_real_escape_string($this->db,$_POST['idstrony']); 
                $escapedstatus = mysqli_real_escape_string($this->db,$_POST['status']); 
                $query = "UPDATE page_list SET page_title = '$escapedtitle', page_content = '$escapedcontent', status = '$escapedstatus' WHERE id = $escapedid LIMIT 1";
                $result = $this->db->query($query);
            }
        }
        // Funkcja odpowiedzialna  za dodawninie nowych podstron
        function DodajPodstrone() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit4'])) {
                $escapedtitle = mysqli_real_escape_string($this->db,$_POST['title']);
                $escapedcontent = mysqli_real_escape_string($this->db,$_POST['content']); 
                $escapedstatus = mysqli_real_escape_string($this->db,$_POST['status']); 
                $query = "INSERT INTO page_list VALUES(default, '$escapedtitle', '$escapedcontent', '$escapedstatus')";
                $result = $this->db->query($query);
            }
        }
        // Funkcja odpowiedzialna  za usuwanie podstron
        function UsunPodstrone() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete1'])) {
                $escapedid = mysqli_real_escape_string($this->db,$_POST['idstrony']); 
                $query = "DELETE FROM page_list WHERE id = $escapedid LIMIT 1";
                $result = $this->db->query($query);
            }
        }

        // Kategorie

        function powrotDoPanelAdmin() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit6'])) {
                header("Location: listSubpage.php");
            }
        }

        function przejdzdokategoriibutton() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit5'])) {
                header("Location: categoryPage.php");
            }
        }
        
        function przejdznasklepbutton() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit14'])) {
                header("Location: shopPage.php");
            }
        }

        function pokazDrzewo(){
            $query = 'SELECT * FROM shop_category WHERE matka=0';
            $result = $this->db->query($query);
            echo '<div class="tree"><p>Drzewo Kategorii</p></div>';
            echo '<div class="listTree">';
            $this->nowaLista($result);
            echo '</div>';
        }
        
        function nowaLista($re){
            echo '<ul>';
            while($row = mysqli_fetch_array($re)){
                echo '<li>'.$row['nazwa'].'</li>';
                $q = 'SELECT * FROM shop_category WHERE matka='.$row['id'];
                $r = $this->db->query($q);
                if(mysqli_num_rows($r) > 0){
                    $this->nowaLista($r);
                }
            }
            echo '</ul>';
        }

        function UsunKategorie() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usun-btn'])) {
                $del = mysqli_real_escape_string($this->db,$_POST['usunID']);
                $query = "DELETE FROM shop_category WHERE id = $del LIMIT 1";
                $result = $this->db->query($query);
                header('location: ./categoryPage.php');
            }
        }

        function wyswietlUsunKategorie(){
            $query = "SELECT * FROM shop_category";
            $result = $this->db->query($query);
            echo '<h1>Usuń kategorie</h1>';
            echo "<table class='tableCat'>
                    <tr>
                    <th>ID</th>
                    <th>Matka</th>
                    <th>Nazwa</th>
                    <th>Usuń</th>
                    </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['matka']."</td>
                    <td>".$row['nazwa']."</td>
                    <td>
                        <form action='./categoryPage.php' method='POST' style='margin: 8px 0;'>
                            <input type='hidden' name='usunID' value='".$row['id']."'/>
                            <input type='submit' name='usun-btn' id='delete' value='Usuń'/>
                        </form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }

        function EdytujKategorie() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editID'])) {
                $editId = mysqli_real_escape_string($this->db,$_POST['editID']);
                $editMatka = mysqli_real_escape_string($this->db,$_POST['matka']); 
                $editNazwa = mysqli_real_escape_string($this->db,$_POST['nazwa']);
                $query = "UPDATE shop_category SET nazwa = '$editNazwa', matka = '$editMatka' WHERE id = $editId LIMIT 1";
                $result = $this->db->query($query);
                header('location: ./categoryPage.php');
            }
        }

        function wyswietlEdytujKategorie(){
            $query = "SELECT * FROM shop_category";
            $result = $this->db->query($query);
            echo '<h1>Edytuj kategorie</h1>';
            echo "<table class='tableCat'>
                    <tr>
                    <th>ID</th>
                    <th>Matka</th>
                    <th>Nazwa</th>
                    <th>Edytuj</th>
                    </tr>
                 </table>";
            while($row = mysqli_fetch_array($result)){
                echo "
                <form class='editCategory' action='./categoryPage.php' method = 'post'>
                    <div>
                        <input value='".$row['id']."' id='idCat' type='number' name='idCat' disabled/>
                    </div>
                    <div>
                        <input value='".$row['matka']."' id='matka' type='number' name='matka'/>
                    </div>
                    <div>
                        <input value='".$row['nazwa']."' id='nazwa' type='text' name='nazwa'/>
                    </div>
                    <div class='btn'> 
                        <input type='hidden' name='editID' value='".$row["id"]."'/>
                        <input id='edit' type='submit' value='Edytuj'/>
                    </div>
                </form>";
            }
        }

        function DodajKategorie() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCategory'])) {
                $addNazwa = mysqli_real_escape_string($this->db,$_POST['nazwa']);
                $addMatka = mysqli_real_escape_string($this->db,$_POST['matka']); 
                $query = "INSERT INTO shop_category VALUES(default, '$addMatka', '$addNazwa')";
                $result = $this->db->query($query);
                header('location: ./categoryPage.php');
            }
        }

        function wyswietlDodajKategorie(){
            $query = "SELECT * FROM shop_category";
            $result = $this->db->query($query);
            echo '<h1>Dodaj kategorie</h1>';
            echo "<table class='tableCat'>
                    <tr>
                    <th>ID</th>
                    <th>Matka</th>
                    <th>Nazwa</th>
                    <th>Dodaj</th>
                    </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['matka']."</td>
                    <td>".$row['nazwa']."</td>
                </tr>";
            }
            echo "</table>";
            echo "
            <form class='editCategory' action='./categoryPage.php' method='post'>
                <div>
                    <span>AutoIncrement</span>
                </div>
                <div>
                    <input value='' id='matka' type='number' name='matka' min='0'/>
                </div>
                <div>
                    <input value='' id='nazwa' type='text' name='nazwa'/>
                </div>
                <div class='btn'> 
                    <input id='addCategory' name='addCategory' type='submit' value='Dodaj Kategorie'/>
                </div>
            </form>";
        }


        // Sklep

        function powrotDoPanelKategorii() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit19'])) {
                header("Location: categoryPage.php");
            }
        }

        function pokazProdukt(){
            $query = "SELECT * FROM produkty";
            $result = $this->db->query($query);
            echo '<h1>Pokaż produkty</h1>';
            while($row = mysqli_fetch_array($result)){
                if($row['status_dostepnosci'] == 1){
                    $status = "Dostępny";
                }else{
                    $status = "Niedostępny";
                }
                echo "
                    <table class='product'>
                        <tr>
                            <td>
                                <img style='width: 200px' src=".$row['zdjecie'].">
                            </td>
                            <td>
                                <span>ID = ".$row['id']."</span></br>
                                <span>Nazwa = ".$row['tytul']."</span></br>
                                <span>Data utworzenia = ".$row['data_utworzenia']."</span></br>
                                <span>Data modyfikacji = ".$row['data_modyfikacji']."</span></br>
                                <span>Data wygaśnięcia = ".$row['data_wygasniecia']."</span></br>
                                <span>Cena netto = ".$row['cena_netto']."zł</span></br>
                                <span>Podatek VAT = ".$row['podatek_vat']."%</span></br>
                                <span>Ilość sztuk = ".$row['ilosc_sztuk']."</span></br>
                                <span>Status = ".$status."</span></br>
                                <span>Kategoria = ".$row['kategoria']."</span></br>
                                <span>Gabaryt = ".$row['gabaryt_produktu']."</span></br>
                            </td>
                        </tr>
                        <tr>
                            <td class='desc'>
                                <h3>Opis</h3>
                                <div>".$row['opis']."</div>
                            </td>
                        </tr>
                    </table>";
            }
        }

        function EdytujProdukt() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editIDProd'])) {
                $editId = mysqli_real_escape_string($this->db,$_POST['editIDProd']);
                $editTytul = mysqli_real_escape_string($this->db,$_POST['tytul']); 
                $editOpis = mysqli_real_escape_string($this->db,$_POST['opis']);
                $editDataU = mysqli_real_escape_string($this->db,$_POST['data_utworzenia']); 
                $editDataM = mysqli_real_escape_string($this->db,$_POST['data_modyfikacji']);
                $editDataW = mysqli_real_escape_string($this->db,$_POST['data_wygasniecia']); 
                $editCena = mysqli_real_escape_string($this->db,$_POST['cena_netto']);
                $editPodatek = mysqli_real_escape_string($this->db,$_POST['podatek_vat']);
                $editIlosc = mysqli_real_escape_string($this->db,$_POST['ilosc_sztuk']);
                $editStatus = mysqli_real_escape_string($this->db,$_POST['status_dostepnosci']);
                $editKategoria = mysqli_real_escape_string($this->db,$_POST['kategoria']);
                $editGabaryt = mysqli_real_escape_string($this->db,$_POST['gabaryt_produktu']);
                $editZdjecie = mysqli_real_escape_string($this->db,$_POST['zdjecie']);
                $query = "UPDATE produkty SET tytul = '$editTytul', opis = '$editOpis', data_utworzenia = '$editDataU', data_modyfikacji = '$editDataM', data_wygasniecia = '$editDataW', cena_netto = '$editCena', podatek_vat = '$editPodatek', ilosc_sztuk = '$editIlosc', status_dostepnosci = '$editStatus', kategoria = '$editKategoria', gabaryt_produktu = '$editGabaryt', zdjecie = '$editZdjecie' WHERE id = $editId LIMIT 1";
                $result = $this->db->query($query);
                header('location: ./shopPage.php');
            }
        }

        function wyswietlEdytujProdukt(){
            $query = "SELECT * FROM produkty";
            $result = $this->db->query($query);
            echo '<h1>Edytuj Produkty</h1>';
            while($row = mysqli_fetch_array($result)){
                echo "
                <form class='editProduct' action='./shopPage.php' method = 'post'>
                    <div>
                        <label for='idProd'>ID</label>
                        <input value='".$row['id']."' id='idProd' type='number' name='idProd' disabled/>
                    </div>
                    <div>
                        <label for='tytul'>Tytuł</label>
                        <input value='".$row['tytul']."' id='tytul' type='text' name='tytul'/>
                    </div>
                    <div>
                        <label for='opis'>Opis</label>
                        <textarea id='opis' name='opis' rows='10' cols='48'>".$row['opis']."</textarea>
                    </div>
                    <div>
                        <label for='data_utworzenia'>Data utworzenia</label>
                        <input value='".$row['data_utworzenia']."' id='data_utworzenia' type='date' name='data_utworzenia'/>
                    </div>
                    <div>
                        <label for='data_modyfikacji'>Data modyfikacji</label>
                        <input value='".$row['data_modyfikacji']."' id='data_modyfikacji' type='date' name='data_modyfikacji'/>
                    </div>
                    <div>
                        <label for='data_wygasniecia'>Data wygaśnięcia</label>
                        <input value='".$row['data_wygasniecia']."' id='data_wygasniecia' type='date' name='data_wygasniecia'/>
                    </div>
                    <div>
                        <label for='cena_netto'>Cena netto</label>
                        <input value='".$row['cena_netto']."' id='cena_netto' type='number' step='0.01' name='cena_netto'/>
                    </div>
                    <div>
                        <label for='podatek_vat'>Podatek VAT</label>
                        <input value='".$row['podatek_vat']."' id='podatek_vat' type='number' name='podatek_vat'/>
                    </div>
                    <div>
                        <label for='ilosc_sztuk'>Ilość sztuk</label>
                        <input value='".$row['ilosc_sztuk']."' id='ilosc_sztuk' type='number' name='ilosc_sztuk'/>
                    </div>
                    <div>
                        <label for='status_dostepnosci'>Status dostępności</label>
                        <input value='".$row['status_dostepnosci']."' id='status_dostepnosci' type='number' min='0' max='1' name='status_dostepnosci'/>
                    </div>
                    <div>
                        <label for='kategoria'>Kategoria</label>
                        <input value='".$row['kategoria']."' id='kategoria' type='text' name='kategoria'/>
                    </div>
                    <div>
                        <label for='gabaryt_produktu'>Gabaryt produktu</label>
                        <input value='".$row['gabaryt_produktu']."' id='gabaryt_produktu' type='text' name='gabaryt_produktu'/>
                    </div>
                    <div>
                        <label for='zdjecie'>zdjęcie</label>
                        <input value='".$row['zdjecie']."' id='zdjecie' type='text' name='zdjecie'/>
                    </div>
                    <div class='btn'> 
                        <input type='hidden' name='editIDProd' value='".$row["id"]."'/>
                        <input id='editProd' type='submit' value='Edytuj'/>
                    </div>
                </form>";
            }
        }

        function UsunProdukt() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usunProd-btn'])) {
                $del = mysqli_real_escape_string($this->db,$_POST['usunProdID']);
                $query = "DELETE FROM produkty WHERE id = $del LIMIT 1";
                $result = $this->db->query($query);
                header('location: ./shopPage.php');
            }
        }

        function wyswietlUsunProdukt(){
            $query = "SELECT * FROM produkty";
            $result = $this->db->query($query);
            echo '<h1>Usuń produkt</h1>';
            echo "<table class='tableCat'>
                    <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Kategoria</th>
                    <th>Ilość sztuk</th>
                    <th>Cena</th>
                    </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['tytul']."</td>
                    <td>".$row['kategoria']."</td>
                    <td>".$row['ilosc_sztuk']." szt</td>
                    <td>".$row['cena_netto']."zł</td>
                    <td>
                        <form action='./shopPage.php' method='POST' style='margin: 8px 0;'>
                            <input type='hidden' name='usunProdID' value='".$row['id']."'/>
                            <input type='submit' name='usunProd-btn' id='delete' value='Usuń'/>
                        </form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }

        function DodajProdukt() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addProd'])) {
                $addTytul = mysqli_real_escape_string($this->db,$_POST['tytul']); 
                $addOpis = mysqli_real_escape_string($this->db,$_POST['opis']);
                $addDataU = mysqli_real_escape_string($this->db,$_POST['data_utworzenia']); 
                $addDataM = mysqli_real_escape_string($this->db,$_POST['data_modyfikacji']);
                $addDataW = mysqli_real_escape_string($this->db,$_POST['data_wygasniecia']); 
                $addCena = mysqli_real_escape_string($this->db,$_POST['cena_netto']);
                $addPodatek = mysqli_real_escape_string($this->db,$_POST['podatek_vat']);
                $addIlosc = mysqli_real_escape_string($this->db,$_POST['ilosc_sztuk']);
                $addStatus = mysqli_real_escape_string($this->db,$_POST['status_dostepnosci']);
                $addKategoria = mysqli_real_escape_string($this->db,$_POST['kategoria']);
                $addGabaryt = mysqli_real_escape_string($this->db,$_POST['gabaryt_produktu']);
                $addZdjecie = mysqli_real_escape_string($this->db,$_POST['zdjecie']);
                $query = "INSERT INTO produkty VALUES(default, '$addTytul', '$addOpis', '$addDataU', '$addDataM', '$addDataW', '$addCena', '$addPodatek', '$addIlosc', '$addStatus', '$addKategoria', '$addGabaryt', '$addZdjecie')";
                $result = $this->db->query($query);
                header('location: ./shopPage.php');
            }
        }

        function wyswietlDodajProdukt(){
            $query = "SELECT * FROM produkty";
            $result = $this->db->query($query);
            echo '<h1>Dodaj Produkty</h1>';
            while($row = mysqli_fetch_array($result)){
                echo "
                <form class='editProduct' action='./shopPage.php' method = 'post'>
                    <div>
                        <label for='idProd'>ID</label>
                        <input value='".$row['id']."' id='idProd' type='number' name='idProd' disabled/>
                    </div>
                    <div>
                        <label for='tytul'>Tytuł</label>
                        <input value='".$row['tytul']."' id='tytul' type='text' name='tytul'/>
                    </div>
                    <div>
                        <label for='opis'>Opis</label>
                        <textarea id='opis' name='opis' rows='10' cols='48'>".$row['opis']."</textarea>
                    </div>
                    <div>
                        <label for='data_utworzenia'>Data utworzenia</label>
                        <input value='".$row['data_utworzenia']."' id='data_utworzenia' type='date' name='data_utworzenia'/>
                    </div>
                    <div>
                        <label for='data_modyfikacji'>Data modyfikacji</label>
                        <input value='".$row['data_modyfikacji']."' id='data_modyfikacji' type='date' name='data_modyfikacji'/>
                    </div>
                    <div>
                        <label for='data_wygasniecia'>Data wygaśnięcia</label>
                        <input value='".$row['data_wygasniecia']."' id='data_wygasniecia' type='date' name='data_wygasniecia'/>
                    </div>
                    <div>
                        <label for='cena_netto'>Cena netto</label>
                        <input value='".$row['cena_netto']."' id='cena_netto' type='number' step='0.01' name='cena_netto'/>
                    </div>
                    <div>
                        <label for='podatek_vat'>Podatek VAT</label>
                        <input value='".$row['podatek_vat']."' id='podatek_vat' type='number' name='podatek_vat'/>
                    </div>
                    <div>
                        <label for='ilosc_sztuk'>Ilość sztuk</label>
                        <input value='".$row['ilosc_sztuk']."' id='ilosc_sztuk' type='number' name='ilosc_sztuk'/>
                    </div>
                    <div>
                        <label for='status_dostepnosci'>Status dostępności</label>
                        <input value='".$row['status_dostepnosci']."' id='status_dostepnosci' type='number' min='0' max='1' name='status_dostepnosci'/>
                    </div>
                    <div>
                        <label for='kategoria'>Kategoria</label>
                        <input value='".$row['kategoria']."' id='kategoria' type='text' name='kategoria'/>
                    </div>
                    <div>
                        <label for='gabaryt_produktu'>Gabaryt produktu</label>
                        <input value='".$row['gabaryt_produktu']."' id='gabaryt_produktu' type='text' name='gabaryt_produktu'/>
                    </div>
                    <div>
                        <label for='zdjecie'>zdjęcie</label>
                        <input value='".$row['zdjecie']."' id='zdjecie' type='text' name='zdjecie'/>
                    </div>
                </form>";
            }
            echo "
            <form class='editProduct' action='./shopPage.php' method = 'post'>
                <div>
                    <label for='idProd'>ID</label>
                    <input value='' id='idProd' type='number' name='idProd' disabled/>
                </div>
                <div>
                    <label for='tytul'>Tytuł</label>
                    <input value='' id='tytul' type='text' name='tytul'/>
                </div>
                <div>
                    <label for='opis'>Opis</label>
                    <textarea id='opis' name='opis' rows='10' cols='48'></textarea>
                </div>
                <div>
                    <label for='data_utworzenia'>Data utworzenia</label>
                    <input value='' id='data_utworzenia' type='date' name='data_utworzenia'/>
                </div>
                <div>
                    <label for='data_modyfikacji'>Data modyfikacji</label>
                    <input value='' id='data_modyfikacji' type='date' name='data_modyfikacji'/>
                </div>
                <div>
                    <label for='data_wygasniecia'>Data wygaśnięcia</label>
                    <input value='' id='data_wygasniecia' type='date' name='data_wygasniecia'/>
                </div>
                <div>
                    <label for='cena_netto'>Cena netto</label>
                    <input value='' id='cena_netto' type='number' step='0.01' name='cena_netto'/>
                </div>
                <div>
                    <label for='podatek_vat'>Podatek VAT</label>
                    <input value='' id='podatek_vat' type='number' name='podatek_vat'/>
                </div>
                <div>
                    <label for='ilosc_sztuk'>Ilość sztuk</label>
                    <input value='' id='ilosc_sztuk' type='number' name='ilosc_sztuk'/>
                </div>
                <div>
                    <label for='status_dostepnosci'>Status dostępności</label>
                    <input value='' id='status_dostepnosci' type='number' min='0' max='1' name='status_dostepnosci'/>
                </div>
                <div>
                    <label for='kategoria'>Kategoria</label>
                    <input value='' id='kategoria' type='text' name='kategoria'/>
                </div>
                <div>
                    <label for='gabaryt_produktu'>Gabaryt produktu</label>
                    <input value='' id='gabaryt_produktu' type='text' name='gabaryt_produktu'/>
                </div>
                <div>
                    <label for='zdjecie'>zdjęcie</label>
                    <input value='' id='zdjecie' type='text' name='zdjecie'/>
                </div>
                <div class='btn'> 
                    <input id='addProd' name='addProd' type='submit' value='Dodaj Produkt'/>
                </div>
            </form>";
        }




















































    }
?>