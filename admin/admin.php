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
                echo "<td><form action='' method='POST'><input type='hidden' name='tempId' value='".$row["id"]."'/><input type='submit' name='submit-btn' class='btn-edit' value='Edytuj' /></td>";
                echo "</form></tr>";
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

        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep
        // Sklep

        // Funkcja odpowiedzialna za wracanie do listy podston panel admin
        function powrotDoPanelAdmin() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit6'])) {
                header("Location: listSubpage.php");
            }
        }
        // Funkcja odpowiedzialna za dodawanie funkcjonalnosci przycicku odpoweidzialnego za przekierowanie do panelu Sklep
        function przejdznasklepbutton() {
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit5'])) {
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




        
















        function edytujKategorie(){
            $query = "SELECT * FROM shop_category";
            $result = $this->db->query($query);
            echo '<h1>Edytuj kategorie</h1>';
            echo "<table class='tableCat'>
                    <tr>
                    <th>ID</th>
                    <th>Matka</th>
                    <th>Nazwa</th>
                    <th>Edytuj</th>
                    </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['matka']."</td>
                    <td>".$row['nazwa']."</td>
                    <td>
                        <form action='' method='POST'><input type='hidden' name='tempId' value='".$row["id"]."'/><input type='submit' name='submit-btn' class='btn-edit' value='Edytuj' /></form>
                    </td>
                </tr>";

            }
            echo "</table>";
        }
        function usunKategorie(){
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
                        <form action='' method='POST'><input type='hidden' name='tempId' value='".$row["id"]."'/><input type='submit' name='submit-btn' class='btn-edit' value='Usuń' /></form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }

        function dodajKategorie(){
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
                    <td>
                        <form action='' method='POST'><input type='hidden' name='tempId' value='".$row["id"]."'/><input type='submit' name='submit-btn' class='btn-edit' value='Dodaj' /></form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }
























    }
?>