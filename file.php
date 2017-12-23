<?php
require_once 'autoload.php';

$file_id = $_GET['id'];

if(empty($file_id)){
	header('Location: 404!'); die();
}

$document = new Document();
$document->get($file_id);

if(empty($document->id)){
	header('Location: 404!'); die();
}

if($document->privacy == 'member')
	$privacy = '<i class="fa fa-user" aria-hidden="true"></i>เฉพาะสมาชิก';
else if($document->privacy == 'public')
	$privacy = '<i class="fa fa-globe" aria-hidden="true"></i>สาธารณะ';
else if($document->privacy == 'onlyme')
	$privacy = '<i class="fa fa-lock" aria-hidden="true"></i>เฉพาะฉัน';
else
	$privacy = '';

if($document->privacy == 'member' && !$user_online){
	header("Location:".DOMAIN."/signin?redirect=".$document->id);
	exit();
}else if($document->privacy == 'onlyme' && $user->id != $document->owner_id){
	header("Location:".DOMAIN."/permission/error");
	exit();
}

$document->updateView($document->id);

$qrcode_filename = 'image/qrcode/'.$document->file_name.'.png';
if(!file_exists($qrcode_filename)){
	require_once 'plugin/phpqrcode/qrlib.php';
	$qrcode_content = DOMAIN.'document/'.$document->file_name;
	QRcode::png($qrcode_content,$qrcode_filename,QR_ECLEVEL_L,8);
}

$currentPage = 'file';
?>

<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php
$p_title 	= (!empty($document->title)?$document->title:TITLE);
$p_desc 	= (!empty($document->description)?$document->description:DESCRIPTION);
$p_url 		= DOMAIN.'/document/'.$document->id;
?>
<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $p_desc;?>"/>
<meta property="og:title" content="<?php echo $p_title;?>"/>
<meta property="og:description" content="<?php echo $p_desc;?>"/>
<meta property="og:url" content="<?php echo $p_url;?>"/>
<meta property="og:image" content="<?php echo OGIMAGE;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo SITENAME;?>"/>
<meta property="fb:app_id" content="<?php echo APP_ID;?>"/>
<meta property="fb:admins" content="<?php echo ADMIN_ID;?>"/>

<meta itemprop="name" content="<?php echo $p_title;?>">
<meta itemprop="description" content="<?php echo $p_desc;?>">
<meta itemprop="image" content="<?php echo OGIMAGE;?>">

<title><?php echo $p_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<a href="index.php" class="btn left"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>

	<?php if($document->privacy != 'onlyme'){?>
	<div class="btn btn-qrcode" id="btn-qrcode"><i class="fa fa-qrcode" aria-hidden="true"></i>QR Code</div>
	<?php }?>
	
	<?php if($user_online && $user->id == $document->owner_id){?>
	<a href="document/edit/<?php echo $document->id;?>" class="btn"><i class="fa fa-cog" aria-hidden="true"></i>แก้ไข</a>
	<?php }?>
</header>

<div class="overlay"></div>
<div id="progressbar"></div>

<div class="container">
	<div class="article">
		<div class="info">
			<span class="icontype <?php echo $document->file_type;?>"><?php echo $document->file_type;?></span>
			<?php if($data['file_privacy'] != 'public'){?>
			<span class="privacy"><?php echo $privacy;?></span>
			<?php }?>
		</div>
		<h1><?php echo $document->title;?></h1>
		<p><?php echo $document->create_time;?></p>

		<?php if(!empty($document->description)){?>
		<div class="text"><?php echo $document->description;?></div>
		<?php }?>
		
		<div class="download">
			<a class="btn-download" title="ดาวน์โหลดไปแล้ว <?php echo $document->download;?> ครั้ง" href="download/<?php echo $document->id;?>" target="_blank">
				<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
				<div class="d">
					<span>ดาวน์โหลดไฟล์</span>
					<span class="size">ขนาดไฟล์ <?php echo $document->file_size;?></span>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="qrcode-dialog" id="qrcode-dialog">
	<div class="head">QR Code เพื่อเข้าถึงไฟล์นี้</div>
	<img src="image/qrcode/<?php echo $document->file_name;?>.png" alt="">
	<div class="control">
		<a href="image/qrcode/<?php echo $document->file_name;?>.png" download="image/qrcode/<?php echo $document->file_name;?>.png" class="btn">บันทึกลงเครื่อง</a>
		<div class="btn btn-close">ปิดหน้าต่าง</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>
</body>
</html>
