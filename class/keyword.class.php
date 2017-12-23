<?php
class Keyword{

	private $db;
    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function save($word){
        $this->db->query('INSERT INTO keyword(word,create_time,ip) VALUE(:word,:create_time,:ip)');
        $this->db->bind(':word'         ,$word);
        $this->db->bind(':create_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->execute();
        return $this->db->lastInsertId();
    }
}
?>
