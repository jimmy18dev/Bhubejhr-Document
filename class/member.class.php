<?php
class Member{
    public $id;
    public $phone;
    public $email;
    public $fullname;
    public $fname;
    public $lname;
    public $bio;
    public $type;
    public $status;
    public $ip;
    public $register_time;
    public $visit_time;
    public $edit_time;
    public $gender;

    // FACEBOOK DATA
    public $fb_id;
    public $fb_fname;
    public $fb_lname;
    public $fb_link;

    private $password;
    private $salt;
    private $db;
    private $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function listAll(){
        $this->db->query('SELECT id,phone,email,fname,lname,bio,password,salt,type,status,ip,register_time,edit_time,visit_time,fb_id,fb_fname,fb_lname,fb_link,gender FROM user ORDER BY register_time DESC');
        $this->db->bind(':user_id',$user_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function updateStatus($user_id,$status){
        $this->db->query('UPDATE user SET status = :status WHERE id = :user_id');
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':status',$status);
        $this->db->execute();
    }

    public function countPending(){
        $this->db->query('SELECT COUNT(id) total FROM user WHERE status = "pending"');
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }

    public function getUser($user_id){
        $this->db->query('SELECT id,phone,email,fname,lname,bio,password,salt,type,status,ip,register_time,edit_time,visit_time,fb_id,fb_fname,fb_lname,fb_link,gender FROM user WHERE id = :user_id');
        $this->db->bind(':user_id',$user_id);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id             = $dataset['id'];
        $this->phone       = $dataset['phone'];
        $this->email        = $dataset['email'];
        $this->fname           = $dataset['fname'];
        $this->lname           = $dataset['lname'];
        $this->fullname = $this->fname.' '.$this->lname;
        $this->bio             = $dataset['bio'];
        $this->password       = $dataset['password'];
        $this->salt           = $dataset['salt'];
        $this->ip             = $dataset['ip'];
        $this->register_time  = $dataset['register_time'];
        $this->visit_time     = $dataset['visit_time'];
        $this->edit_time     = $dataset['edit_time'];
        $this->type           = $dataset['type'];
        $this->status         = $dataset['status'];
        $this->gender         = $dataset['gender'];

        $this->fb_id         = $dataset['fb_id'];
        $this->fb_fname         = $dataset['fb_fname'];
        $this->fb_lname         = $dataset['fb_lname'];
        $this->fb_link         = $dataset['fb_link'];
    }
}
?>