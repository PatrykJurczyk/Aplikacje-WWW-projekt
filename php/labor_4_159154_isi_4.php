<?php

$nr_indeksu = '159154';
$nrGrupy = 'ISI4';

echo "Patryk Jurczyk $nr_indeksu grupa $nrGrupy <br/><br/>"; 
echo "Zastosowanie metody include() <br/><br/>";
echo 'Patryk Jurczyk' .$nr_indeksu. 'grupa' .$nrGrupy. '<br/><br/>'; 
echo 'Zastosowanie metody include() <br/><br/>';

// Include

function foo(){
    include 'vars.php';
    echo "A $color $fruit";
}

foo();

echo '<br/><br/>';

// require_once

function foo1(){
    require_once('var.php');
    return $foo1;

}

function foo2(){
    for($a=1;$a<=5;$a++){
        echo foo1()."<br>";
    }
}

foo2();

echo '<br/><br/>';

// if, elseif, else

function foo3(){
    $a = '5';
    $b = '4';

    if ($a > $b)
     echo "a jest wieksze od b";
    elseif($a < $b)
     echo "b jest wieksze od a";
    else
        echo "a jest równe b";
}

foo3();

echo '<br/><br/>';

// switch

function foo4(){
    $i = 2;
    switch ($i) {
        case 0:
            echo "i = 0";
            break;
        case 1:
            echo "i = 1";
            break;
        case 2:
            echo "i = 2";
            break;
    }
}

foo4();

echo '<br/><br/>';

// while

function foo5(){
    $i = 1;
    while ($i <= 10) {
       echo "$i <br/>";  
       $i++;
    }
}

foo5();

echo '<br/><br/>';

// for

function foo6(){
    for ($i = 100; $i >= 10; $i-=10) {
       echo "$i <br/>";  
    }
}

foo6();

// $_GET

$_GET['imieusera'] = "Patryk";
echo 'Witaj ' . htmlspecialchars($_GET["imieusera"]) . '!';

echo '<br/><br/>';

// $_POST

$_POST['imieusera'] = "Patryk";
echo 'Witaj ' . htmlspecialchars($_POST["imieusera"]) . '!';

echo '<br/><br/>';

// $_SESSION

session_start();
$_SESSION["newsession"]='123456789';

echo '</br>';

echo $_SESSION["newsession"];

echo '<br/><br/>';
?>