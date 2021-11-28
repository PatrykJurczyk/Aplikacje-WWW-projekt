<?php
class Admin{
    private $db;

    function __construct($db) {
		$this->db = $db;
	}

    function login() {
        session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

            $myusername = mysqli_real_escape_string($this->db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($this->db,$_POST['password']); 
            $q = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
            $result = $this->db->query($q);
            $row = mysqli_fetch_array($result);

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
    
    function logout() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit2'])) {
            if(session_destroy()) {
                header("Location: login.php");
            }
        }
    }
    
    function powrotDoListPods() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit8'])) {
            header("Location: listSubpage.php");
        }
    }

    function powrotDoProjektu() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit9'])) {
            header("Location: index.php");
        }
    }

    function dodajnowabutton() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit10'])) {
            header("Location: addPage.php");
        }
    }

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

    function WywolajEdit() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tempId'])) {
            echo $_POST['tempId'];
            header("Location: adminPage.php?idstrony=".$_POST['tempId']);
        }
    }

    function EdytujPodstrone() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit3'])) {
            $escapedtitle = mysqli_real_escape_string($this->db,$_POST['title']);
            $escapedcontent = mysqli_real_escape_string($this->db,$_POST['content']); 
            $escapedid = mysqli_real_escape_string($this->db,$_POST['idstrony']); 
            $escapedstatus = mysqli_real_escape_string($this->db,$_POST['status']); 
            $query = "UPDATE page_list SET page_title = '$escapedtitle', page_content = '$escapedcontent', status = '$escapedstatus' WHERE id = $escapedid LIMIT 1";
            $result = $this->db->query($query);
            // echo $result;
        }
    }

    function DodajPodstrone() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit4'])) {
            $escapedtitle = mysqli_real_escape_string($this->db,$_POST['title']);
            $escapedcontent = mysqli_real_escape_string($this->db,$_POST['content']); 
            $escapedstatus = mysqli_real_escape_string($this->db,$_POST['status']); 
            $query = "INSERT INTO page_list VALUES(default, '$escapedtitle', '$escapedcontent', '$escapedstatus')";
            $result = $this->db->query($query);
            // echo $result;
        }
    }
    function UsunPodstrone() {
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete1'])) {
            $escapedid = mysqli_real_escape_string($this->db,$_POST['idstrony']); 
            $query = "DELETE FROM page_list WHERE id = $escapedid LIMIT 1";
            $result = $this->db->query($query);
            // echo $result;
        }
    }
}
?>