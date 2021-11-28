<?php
class PokazStrone{
    
    private $db;

    function __construct($db) {
		$this->db = $db;
	}

    function PokazPodstrone($id) {
        $id_clear = htmlspecialchars($id);
        $q = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
        $result = $this->db->query($q);
        
        while($obj = $result->fetch_object()){
            if(empty($obj->id)){
                $web = 'Nie znaleziono strony';
            } else{
                $web = $obj->page_content;
            }
        }
        return $web;
    }
}
?>