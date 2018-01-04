<?php
class Category{

    public $id;
    public $name;
    public $description;
    public $edit_time;

	private $db;
    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($category_id){
        $this->db->query('SELECT id,name,description,edit_time FROM category WHERE id = :category_id');
        $this->db->bind(':category_id',$category_id);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id           = $dataset['id'];
        $this->name         = $dataset['name'];
        $this->description  = $dataset['description'];
        $this->edit_time    = $dataset['edit_time'];

        return $dataset;
    }

    public function create($name,$description){
        $this->db->query('INSERT INTO category(name,description,edit_time) VALUE(:name,:description,:edit_time)');
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':edit_time'    ,date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function edit($category_id,$name,$description){
        $this->db->query('UPDATE category SET name = :name,description = :description,edit_time = :edit_time WHERE id = :category_id');
        $this->db->bind(':category_id'  ,$category_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':edit_time'    ,date('Y-m-d H:i:s'));
        $this->db->execute();
    }
    public function delete($category_id){
        $this->db->query('DELETE FROM category WHERE id = :category_id');
        $this->db->bind(':category_id'  ,$category_id);
        $this->db->execute();
    }

    public function listAll(){
    	$this->db->query('SELECT category.id category_id,category.name category_name,category.description category_desc,(SELECT COUNT(id) FROM document WHERE category_id = category.id) category_count FROM category AS category ORDER BY category.id DESC');
		$this->db->execute();
		$dataset = $this->db->resultset();

		foreach ($dataset as $k => $var){
			$dataset[$k]['category_count'] = floatval($var['category_count']);
		}
		return $dataset;
    }
}
?>
