<?php
require_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/signin');
	die();
}else if($user->status != 'active'){
	header("Location:".DOMAIN."/permission.php?e=UserNotActive");
	die();
}

$category_id = $_GET['category'];

if(empty($category_id)){
	header('Location: '.DOMAIN.'/create/choose');
	die();
}

$category = new Category();
$document = new Document();
$category->get($category_id);

if(empty($category->id)){
	header('Location: 404!');
	die();
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

<title>เอกสารใหม่: <?php echo $category->name;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header light">
	<a href="create/choose" class="btn btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>เลือกประเภท</span></a>
	<div class="title">ประเภท: <?php echo $category->name;?></div>

	<a href="index.php" class="btn btn-cancel"><i class="fa fa-close" aria-hidden="true"></i><span>ยกเลิก</span></a>
</header>

<form action="upload_document.php" class="form" id="documentForm" method="POST" enctype="multipart/form-data">
	<div class="form-items middle">
		<div class="file-preview" id="filePreview">
			<i class="fa fa-paperclip" aria-hidden="true"></i>
			<p id="fileName">เลือกไฟล์เอกสารของคุณ</p>
			<div id="fileSizeInfo" class="info"></div>
		</div>
		<input type="file" name="file" class="inputfile" id="file" required>
	</div>

	<div class="form-items hidden">
		<label for="title">ชื่อไฟล์</label>
		<input class="inputtext" type="text" name="title" id="title" required placeholder="ตั้งชื่อไฟล์">
	</div>

	<div class="form-items hidden">
		<label for="description">รายละเอียด</label>
		<textarea name="description" id="description" placeholder="รายละเอียด..."></textarea>
	</div>

	<div class="form-items hidden">
		<input type="hidden" id="maximumSize" value="<?php echo $document->return_bytes(ini_get('post_max_size'));?>">
		<input type="hidden" name="category_id" required value="<?php echo $category->id;?>">
		<button type="submit" id="btnSubmit" class="fullsize" disabled>อัพโหลดเอกสาร</button>
	</div>
</form>

<div class="overlay">
	<div class="icon-loading"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
</div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/document.form.js"></script>
</body>
</html>