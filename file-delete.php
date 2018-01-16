<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
}

$file_id = $_GET['id'];

if(empty($file_id)){
	header('Location: 404!'); die();
}

$document = new Document();
$document->get($file_id);

if(empty($document->id)){
	header('Location: 404!'); die();
}

$category = new Category();
$categories = $category->listAll();

if($user->id != $document->owner_id){
	header("Location:./permission.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title>แก้ไข: <?php echo $document->title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header">
	<a href="document/<?php echo $document->id;?>" class="btn btn-cancel"><i class="fa fa-close" aria-hidden="true"></i><span>ยกเลิก</span></a>
</header>

<div class="form">
	<div class="form-items delete-box">
		<div class="msg"><strong>คำเตือน:</strong> เมื่อคุณกดลบไฟล์ <u><?php echo $document->title;?></u> แล้ว ระบบจะถามเพื่อยืนยันความต้องการอีกครั้ง เมื่อลบไฟล์คุณจะไม่สามารถกู้คืนไฟล์ได้อีก!</div>

		<input type="hidden" id="title" value="<?php echo $document->title;?>">
		<input type="hidden" id="file_id" value="<?php echo $document->id;?>">
		<button id="btnDelete" class="fullsize btn-delete">ลบไฟล์นี้</button>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/document.js"></script>
</body>
</html>