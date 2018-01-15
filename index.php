<?php
require_once 'autoload.php';

$document 	= new Document();
$files 		= $document->listAll(NULL,NULL,NULL);
$dataset 	= [];
foreach ($files as $k => $v){
	$date = $wpdb->datetimeformat(date('Y-m-d',$v['file_create_timestamp']),'topicdate');

	if(!in_array($date, array_column($dataset,'date'))){
		$structure = array(
			'date' 	=> $date,
			'items' => []
		);

		array_push($dataset,$structure);
	}

	$pos = array_search($date, array_column($dataset,'date'));
	array_push($dataset[$pos]["items"],$files[$k]);
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

<?php include'favicon.php';?>

<?php
$p_title 	= 'เอกสารออนไลน์ - '.TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN;
?>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $p_desc;?>"/>
<meta property="og:title" content="<?php echo $p_title;?>"/>
<meta property="og:description" content="<?php echo $p_desc;?>"/>
<meta property="og:url" content="<?php echo DOMAIN;?>"/>
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
<header class="header fixed">
	<?php include 'template/header.logo.php';?>
	<?php if($user_online){ include 'template/header.profile.php'; }else{?>
	<a href="signup" class="btn btn-login">ลงทะเบียนใหม่<i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<a href="search.php" class="btn btn-search" class="btn-search"><i class="fa fa-search" aria-hidden="true"></i>ค้นหา</a>
</header>

<div class="cover">
	<?php if(DEVICE_TYPE == 'Mobile'){?>
	<img src="image/cover_square.jpg" alt="">
	<?php }else{?>
	<img src="image/cover.jpg" alt="">
	<?php }?>
	<div class="filter"></div>
	<div class="welcome">
		<h1>ระบบเอกสารออนไลน์</h1>
		<p>โรงพยาบาลเจ้าพระยาอภัยภูเบศร จ.ปราจีนบุรี</p>
		
		<?php if(!$user_online){?>
		<a href="signin">ลงชื่อเข้าใช้<i class="fa fa-angle-right" aria-hidden="true"></i></a>
		<?php }else{?>
		<a href="create/choose">อัพโหลดไฟล์<i class="fa fa-plus" aria-hidden="true"></i></a>
		<?php }?>
	</div>
</div>
<div class="container nomargin">
	<?php foreach ($dataset as $var){?>
	<div class="date"><?php echo $var['date'];?></div>
	<div class="list">
		<?php
		foreach ($var['items'] as $data){ include 'template/file.items.php'; }
		?>
	</div>
	<?php }?>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>