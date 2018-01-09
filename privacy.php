<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
}

$document = new Document();
$category = new Category();
$categories = $category->listAll();
$file_id = $_GET['id'];
$document->get($file_id);

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


<title>สิทธิ์เข้าถึง: <?php echo $document->title;?></title>
<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header">
	<div class="title">ไฟล์: <?php echo $document->title;?></div>
</header>

<div class="form">
	<div class="form-items middle">
		<label for="">สิทธิ์เข้าถึงเอกสารนี้</label>
		<div class="selection">
			<div class="items privacy-items" id="privacy-public" data-v="public">
				<i class="fa fa-globe" aria-hidden="true"></i>
				<div class="caption">
					<div class="t">สาธารณะ</div>
					<div class="c">ทุกคนสามารถเห็นไฟล์นี้ได้</div>
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
	</div>
	<input type="hidden" id="verified" value="<?php echo $user->verified;?>">
	<input type="hidden" id="privacy" value="<?php echo $document->privacy;?>">
	<input type="hidden" id="file_id" value="<?php echo $document->id;?>">
	
	<div class="form-items control">
		<button id="btnPrivacySave">บันทึกสิทธิ์</button>
		<a href="document/<?php echo $document->id;?>" class="btn">ข้ามขั้นตอนนี้</a>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/document.js"></script>
</body>
</html>
