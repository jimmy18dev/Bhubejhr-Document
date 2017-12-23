<?php
require_once'autoload.php';
require_once 'plugin/phpqrcode/qrlib.php';
header("Content-type: application/json");

$document       = new Document;

$category_id    = $_POST['category_id'];
$title          = $_POST['title'];
$description    = $_POST['description'];

if(isset($_FILES['file'])){
    $errors     = array();
    $file_name  = $_FILES['file']['name'];
    $file_size  = $_FILES['file']['size'];
    $file_tmp   = $_FILES['file']['tmp_name'];
    $file_type  = $_FILES['file']['type'];
    $file_ext   = pathinfo($file_name,PATHINFO_EXTENSION);
    $expensions = array('pdf','xls','xlsx','doc','docx','txt','ppt','pptx','zip');

    if(in_array($file_ext,$expensions) === false){
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > $document->return_bytes(ini_get('post_max_size')) || $file_siz > $document->return_bytes(ini_get('upload_max_filesize'))){
        $errors[] = 'File size must be excately '.ini_get('post_max_size').' MB';
    }

    if(empty($errors) == true){
        if(!empty($title) && isset($title))
            $filename = $title;
        else{
            $filename = $file_name;
        }
        
        $filename       = $document->string_cleaner($filename);
        $new_filename   = $filename.'-'.substr(md5(time().rand(0,9999999999)),6,6);
        $full_filename = $new_filename.'.'.$file_ext;
        move_uploaded_file($file_tmp,'files/'.$full_filename);

        $file_id = $document->create($user->id,$category_id,$filename,$description,$full_filename,$file_ext,$file_size);

        $qrcode_content = DOMAIN.'document/'.$file_id;
        $qrcode_filename = 'image/qrcode/'.$full_filename.'.png';
        
        QRcode::png($qrcode_content,$qrcode_filename);
    }else{
        // print_r($errors);
        $file_id = -1;
    }
}

$data = array(
    "apiVersion"    => 1.0,
    "message"       => 'File upload Successed!',
    "file_id"       => floatval($file_id),
    "filename"      => $new_filename,
    "qr_content"    => $qrcode_content,
    "qr_filename"   => $qrcode_filename,
    "execute"       => floatval(round(microtime(true)-StTime,4))
);

echo json_encode($data);
?>