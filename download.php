<?php
require_once 'autoload.php';
$document = new Document();
$file_id = $_GET['id'];

if(!empty($file_id) && isset($file_id)){
	$document->get($file_id);
	$document->updateDownload($document->id);

	if(!empty($document->id)){
		header("Location:".DOMAIN."/files/".$document->file_name);
		exit();
	}else{
		header("Location:".DOMAIN);
		exit();
	}
}else{
	header("Location:".DOMAIN);
	exit();
}
?>