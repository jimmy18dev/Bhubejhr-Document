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
		$icon = 'PDF';
		break;
	case 'Word':
		$icon = 'Microsoft Word';
		break;
	case 'Excel':
		$icon = 'Microsoft Excel';
		break;
	case 'PowerPoint':
		$icon = 'Microsoft Power Point';
		break;
	case 'Zip':
		$icon = 'Zip';
		break;
	case 'txt':
		$icon = 'Text';
		break;
	default:
		$icon = '';
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
<header class="header light">
	<?php include 'template/header.logo.php'; ?>

	<?php if($user_online && $user->id == $document->owner_id){?>
	<div class="btn btn-login" id="btnOption">
		ตัวเลือก<i class="fa fa-angle-down" aria-hidden="true"></i>

		<div class="more-menu" id="menuOption">
			<div class="arrow-up"></div>
			<a href="document/edit/<?php echo $document->id;?>"><i class="fa fa-cog" aria-hidden="true"></i>แก้ไขเอกสาร</a>
			<a href="document/delete/<?php echo $document->id;?>" class="btn-logout"><i class="fa fa-trash" aria-hidden="true"></i>ลบไฟล์นี้</a>
		</div>
	</div>
	<?php }?>
</header>

<div class="container nomargin">
	<div class="article">
		<h1><?php echo $document->title;?></h1>
		<p>
			<a href="category/<?php echo $document->category_id?>" class="style<?php echo $document->category_id?>"><?php echo $document->category_name; ?></a> · <?php echo $document->create_time;?> · <?php echo $privacy;?>
		</p>

		<?php if(!empty($document->description)){?>
		<div class="text"><?php echo $document->description;?></div>
		<?php }?>
		
		<div class="download">
			<?php if($document->privacy != 'onlyme'){?>
			<div class="btn btn-qrcode" id="btn-qrcode">
				<div class="d">
					<span class="caption">แสดงคิวอาร์โค้ด</span>
					<span class="size">สแกนด้วยโทรศัพท์มือถือ</span>
				</div>
				<i class="fa fa-qrcode" aria-hidden="true"></i>
			</div>
			<?php }?>

			<a class="btn btn-download" title="ดาวน์โหลดไปแล้ว <?php echo $document->download;?> ครั้ง" href="download/<?php echo $document->secret;?>" target="_blank">
				<div class="d">
					<span class="caption">ดาวน์โหลดไฟล์</span>
					<span class="size"><?php echo $icon;?> ขนาดไฟล์ <?php echo $document->file_size;?></span>
				</div>
				<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<div class="dialog" id="qrcode-dialog">
	<div class="head">
		<div class="text">คิวอาร์โค้ด</div>
		<div class="btn btn-close"><i class="fa fa-close" aria-hidden="true"></i></div>
	</div>
	<img src="image/qrcode/<?php echo $document->file_name;?>.png" alt="">
	<div class="control">
		<a href="image/qrcode/<?php echo $document->file_name;?>.png" download="image/qrcode/<?php echo $document->file_name;?>.png" target="_blank" class="btn fullsize"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>บันทึกคิวอาร์โค้ด</a>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>
</body>
</html>
