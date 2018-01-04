<?php
require_once 'autoload.php';
$document = new Document();
$secret = $_GET['secret'];

if(!empty($secret) && isset($secret)){
	$document->getDocumentFromSecret($secret);
	$document->updateDownload($document->id);

	if(!empty($document->id)){
		header("Location:".DOMAIN."/files/".$document->file_name);
		exit();
	}else{
		header("Location:".DOMAIN."/file-not-found");
		exit();
	}
}else{
	header("Location:".DOMAIN."/secret-is-empty");
	exit();
}
?>