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

switch ($document->file_type) {
	case 'PDF':
		$icon = '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>PDF';
		break;
	case 'Word':
		$icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>Microsoft Word';
		break;
	case 'Excel':
		$icon = '<i class="fa fa-file-excel-o" aria-hidden="true"></i>Microsoft Excel';
		break;
	case 'PowerPoint':
		$icon = '<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>Microsoft Power Point';
		break;
	case 'Zip':
		$icon = '<i class="fa fa-file-zip-o" aria-hidden="true"></i>Zip';
		break;
	case 'txt':
		$icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>Text';
		break;
	default:
		$icon = '<i class="fa fa-file-o" aria-hidden="true"></i>';
		break;
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
	<!-- <a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><span>กลับหน้าแรก</span></a> -->

	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>">
		<img src="image/logo.png" alt="logo">
		<div class="detail">
			<div class="name">Documents</div>
			<div class="desc">Chao Phraya Abhaibhubej Hospital</div>
		</div>
	</a>

	<?php if($document->privacy != 'onlyme'){?>
	<div class="btn btn-qrcode" id="btn-qrcode"><i class="fa fa-qrcode" aria-hidden="true"></i>QR Code</div>
	<?php }?>
</header>

<div class="overlay"></div>
<div id="progressbar"></div>

<div class="container">
	<div class="article">
		<div class="info">
			<span class="<?php echo $document->file_type;?>"><?php echo $icon;?></span>
			<?php if($user_online && $user->id == $document->owner_id){?>
			<a href="document/edit/<?php echo $document->id;?>">แก้ไข<i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<?php }?>
		</div>
		<h1><?php echo $document->title;?></h1>
		<p>
			<a href="category/<?php echo $document->category_id?>" class="style<?php echo $document->category_id?>"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $document->category_name; ?></a>
			<span><?php echo $document->create_time;?></span>
			<span class="privacy"><?php echo $privacy;?></span>
		</p>

		<?php if(!empty($document->description)){?>
		<div class="text"><?php echo $document->description;?></div>
		<?php }?>
		
		<div class="download">
			<div class="filename" title="<?php echo $document->file_name;?>"><?php echo $document->file_name;?></div>
			<a class="btn-download" title="ดาวน์โหลดไปแล้ว <?php echo $document->download;?> ครั้ง" href="download/<?php echo $document->id;?>" target="_blank">
				<div class="d">
					<span class="caption">ดาวน์โหลดไฟล์</span>
					<span class="size">ขนาดไฟล์ <?php echo $document->file_size;?></span>
				</div>
				<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
