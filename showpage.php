<?php
function PokazPodstrone($db, $id) {
    // Pierwszy sposób.

    // $id_clear = htmlspecialchars($id);
    // $result = $db->query("SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1");
    
    // $row = mysqli_fetch_array($result);

    // if(empty($row['id']))
    // {
    //     $web = 'Nie znaleziono strony';
    // }
    // else
    // {
    //     $web = $row['page_content'];
    // }

    // return $web;

    // Sposób obiektowo.
    $id_clear = htmlspecialchars($id);
    $q = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = $db->query($q);

    while($obj = $result->fetch_object()){
        if(empty($obj->id)){
            $web = 'Nie znaleziono strony';
        } else{
            $web = $obj->page_content;
        }
    }
    return $web;
}
?>