<?php
    session_start();

    $_SESSION['count'] = -1;
    $event = $_POST['event'];
    $numer = $_POST['numer'];

    $qty = $_POST['name3'];
    $tytul = $_POST['name1'];
    $cena = $_POST['name2'];
    $zdjecie = $_POST['name0'];
  
    $podatek = $_POST['name4'];
    $iloscSztuk = $_POST['name5'];
    
    $product = array($zdjecie, $tytul, $cena, $qty, $podatek, $iloscSztuk, $numer);
    
    if($event == 'Delete'){
        unset($_SESSION['koszyk'][$numer]);
        header("Location: ./koszyk.php");
    } else if($event == 'Wróć na sklep'){
        header("Location: ./shop.php");
        $_SESSION['koszyk'] = array();
    }

?>