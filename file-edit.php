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

<div class="form" id="documentForm">
	<div class="form-items">
		<label for="">ชื่อไฟล์</label>
		<input class="inputtext" type="text" id="title" value="<?php echo $document->title;?>">
	</div>

	<div class="form-items">
		<label for="">รายละเอียด</label>
		<textarea id="description"><?php echo $document->description;?></textarea>
	</div>

	<div class="form-items">
		<label for="">สิทธิ์เข้าถึงเอกสาร</label>
		<div class="selection">
			<div class="items privacy-items" id="privacy-public" data-v="public">
				<i class="fa fa-globe" aria-hidden="true"></i>
				<div class="caption">
					<div class="t">สาธารณะ</div>
					<div class="c">ใครก็สามารถเห็นไฟล์นี้ได้</div>
				</div>
			</div>
			<div class="items privacy-items" id="privacy-member" data-v="member">
				<i class="fa fa-user" aria-hidden="true"></i>
				<div class="caption">
					<div class="t">เจ้าหน้าที่</div>
					<div class="c">เข้าถึงได้เฉพาะเจ้าหน้าที่เท่านั้น</div>
				</div>
			</div>
			<div class="items privacy-items" id="privacy-onlyme" data-v="onlyme">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<div class="caption">
					<div class="t">เฉพาะฉัน</div>
					<div class="c">คุณคนเดียวเท่านั้นที่เห็นไฟล์นี้</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="verified" value="<?php echo $user->verified;?>">
		<input type="hidden" id="privacy" value="<?php echo $document->privacy;?>">
	</div>

	<div class="form-items">
		<label for="">ประเภทเอกสาร</label>
		<div class="select">
	      <select id="category_id" class="form-control">
	        <option value="0">เลือกหน่วยแพทย์...</option>
	        <?php foreach ($categories as $var) {?>
	        <option value="<?php echo $var['category_id'];?>" <?php echo ($var['category_id'] == $document->category_id?'selected':'')?>><?php echo $var['category_name'];?></option>
	        <?php }?>
	      </select>
	    </div>
	</div>
	<div class="form-items">
		<input type="hidden" id="file_id" value="<?php echo $document->id;?>">
	    <button id="btnSave" class="fullsize">บันทึกการแก้ไข</button>
	</div>
</div>

<div class="overlay">
	<div class="icon-loading"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
</div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/document.js"></script>
</body>
</html>