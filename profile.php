<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
}

$document 	= new Document();
$files 		= $document->listAll(NULL,$user->id,NULL);
?>

<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title>เอกสารทั้งหมด</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header shadow">
	<a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><span>หน้าแรก</span></a>
	<div class="title">เอกสารทั้งหมดของคุณ</div>

	<?php include 'template/header.profile.php'; ?>
</header>

<div class="container nomargin">
	<div class="topic">รายการล่าสุด</div>
	<?php if(count($files) > 0){?>
	<div class="list">
	<?php
		foreach ($files as $data)
			include 'template/file.items.php';
	?>
	</div>
	<?php }else{?>
	<div class="starter">
		<p>คุณยังไม่เคยอัพโหลดเอกสารใดๆ</p>
		<a href="create/choose"><i class="fa fa-cloud-upload" aria-hidden="true"></i>อัพโหลดไฟล์</a>
	</div>
	<?php }?>
</div>

<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
