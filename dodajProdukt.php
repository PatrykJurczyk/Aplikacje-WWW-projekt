<?php
  session_start();

  if(!isset($_SESSION['koszyk'])){
    $_SESSION['koszyk'] = array('product'=>array());
  }

  if(!isset($_SESSION['count'])){
    $_SESSION['count'] = -1;
  } else{
    $_SESSION['count']++;
  }
  
  $nr = $_SESSION['count'];
  $qty = $_POST['qty'];
  $tytul = $_POST['tytul'];
  $cena = $_POST['cena'];
  $zdjecie = $_POST['zdjecie'];

  $podatek = $_POST['podatek'];
  $iloscSztuk = $_POST['iloscSztuk'];
  

  $product = array($zdjecie, $tytul, $cena, $qty, $podatek, $iloscSztuk, $nr);
  array_push($_SESSION['koszyk'], $product);

  header("Location: ./shop.php");

?>