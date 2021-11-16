<?php
function PokazPodstrone($db, $id) {

    $id_clear = htmlspecialchars($id);
    $result = $db->query("SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1");
    $row = mysqli_fetch_array($result);

    if(empty($row['id']))
    {
        $web = 'Nie znaleziono strony';
    }
    else
    {
        $web = $row['page_content'];
    }

    return $web;
}
?>