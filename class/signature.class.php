<?php
class Signature{

    private $expire = 60; // 20 Min.
    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function generateSignature($form,$secretKey){
        // clear expire signature.
        $this->clearSign();

        // lowercase everything
        $dataString = strtolower(hash('sha512',uniqid(mt_rand(1,mt_getrandmax()),true)));

        // generate signature using the SHA256 hashing algorithm
        $sign = hash_hmac('sha256',$dataString.$form,$secretKey);

        // Save key into Database
        $this->db->query('INSERT INTO signature(sign,expire,create_time,form) VALUE(:sign,:expire,:create_time,:form)');
        $this->db->bind(':sign'            ,$sign);
        $this->db->bind(':expire'          ,time() + $this->expire);
        $this->db->bind(':create_time'     ,date('Y-m-d H:i:s'));
        $this->db->bind(':form'            ,$form);
        $this->db->execute();

        return $sign;
    }

    public function verifySign($sign){

        if(empty($sign)) return false;

        $old_sign = $this->get($sign);

        if($sign == $old_sign){
            // $this->removeSign($sign); // REMOVE THIS SIGN
            return true;
        }else{
            return false;
        }
    }

    public function create($sign_key,$type){
        $this->db->query('INSERT INTO signature(sign_key,expire,type) VALUE(:sign_key,:expire,:type)');
        $this->db->bind(':sign_key',       $sign_key);
        $this->db->bind(':expire',         time()+(60*20));
        $this->db->bind(':type',           $type);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function get($sign){
        $this->db->query('SELECT sign FROM signature WHERE (sign = :sign AND expire > :now)');
        $this->db->bind(':sign'    ,$sign);
        $this->db->bind(':now'     ,time());
        $this->db->execute();
        $data = $this->db->single();

        if(!empty($data['sign']) && isset($data['sign'])){
            $this->db->query('UPDATE signature SET active_time = :active_time WHERE sign = :sign');
            $this->db->bind(':sign'            ,$data['sign']);
            $this->db->bind(':active_time'     ,date('Y-m-d H:i:s'));
            $this->db->execute();
        }

        return $data['sign'];
    }

    private function removeSign($sign){
        $this->db->query('DELETE FROM signature WHERE sign = :sign');
        $this->db->bind(':sign',$sign);
        $this->db->execute();
    }

    private function clearSign(){
        $this->db->query('DELETE FROM signature WHERE (expire < :now)');
        $this->db->bind(':now',time());
        $this->db->execute();
    }
}
?>