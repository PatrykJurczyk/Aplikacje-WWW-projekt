<?php
  session_start();
  echo '</br>';
  echo '</br>';
  echo '</br>';
  echo '</br>';
  echo '</br>';
    echo "
    <table class='table'>
      <thead>
        <tr>
          <th>Numer produktu</th>
          <th>Zdjęcie</th>
          <th>Nazwa</th>
          <th>Cena</th>
          <th>Ilość</th>
          <th>Całkowita cena</th>
          <th>Delete</th>
          <th>Wróć na sklep</th>
        </tr>
      </thead>
      <tbody>";
          $sno = 1;
          foreach($_SESSION['koszyk'] as $products){
            $licz = count($_SESSION['koszyk']);
            $p = 0;
            $q = 0;
            $podatek = 0;
            $iloscS = $products[5];
            echo "<tr>";
              echo "<td>".($sno++)."</td>";
              echo "<form action='./edytujStanKoszyka.php' method='post'>";
                foreach($products as $key => $value){
                  if($key == 3){
                    echo "<td><input type='number' name='name$key' value='".$value."' min='1' max='".$iloscS."'/></td>";
                    $q = $value;
                  } else if($key == 2){
                    echo "<input type='hidden' name='name$key' value='".$value."'/>";
                    echo "<td>".$value."</td>";
                    $p = $value;
                  } else if($key == 1){
                    echo "<input type='hidden' name='name$key' value='".$value."'/>";
                    echo "<td>".$value."</td>";
                  } else if($key == 0){
                    echo "<input type='hidden' name='name$key' value='".$value."'/>";
                    echo "<td><img src='".$value."'/></td>";
                  } else if($key == 4){
                    echo "<input type='hidden' name='name$key' value='".$value."'/>";
                    $podatek = $value;
                    $podatek = $podatek/100;
                  }
                }
                $totalPrice = ($p * $podatek)*$q + ($p * $q);
                echo "<td>".$totalPrice."</td>";
                echo "<input type='hidden' name='name5' value='".$iloscS."'/>";
                echo "<input type='hidden' name='numer' value='".$products[6]."'/>";
                echo "<input type='hidden' name='pom' value='".$licz."'/>";
                echo "<td><input type='submit' name='event' value='Delete' class=''></td>";
                echo "<td><input type='submit' name='event' value='Wróć na sklep' class=''></td>";
              echo "</form>";
              echo "</tr>";
          }
    echo"
      </tbody>
    </table>
    ";
?>
