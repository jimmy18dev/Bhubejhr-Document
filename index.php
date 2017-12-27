<?php
require_once 'autoload.php';

$document = new Document();
$category = new Category();

$files = $document->listAll(NULL,NULL,NULL);
$categories = $category->listAll();

// $feeds = $categories;
// foreach ($feeds as $k => $var) {
// 	$dataset = [];
// 	foreach ($files as $i => $val) {
// 		if($var['category_id'] == $val['file_category_id']){
// 			array_push($dataset,$val);
// 		}
// 	}

// 	$feeds[$k]['totalitems'] = count($dataset);

// 	if(count($dataset)>0)
// 		$feeds[$k]['dataset'] = $dataset;
// }
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
$p_title 	= TITLE;
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

<?php include_once 'header.php';?>
<div class="menu">
	<a href="search.php" class="items btn-search"><i class="fa fa-search" aria-hidden="true"></i><span>ค้นหาไฟล์</span></a>
	<a href="create/choose" class="items btn-upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i><span>อัพโหลด</span></a>
	<a href="categories.php" class="items btn-category"><i class="fa fa-th-list" aria-hidden="true"></i><span>หมวดหมู่</span></a>
</div>
<div class="container">
	<div class="section">
		<?php if(count($files) > 0){?>
		<div class="topic">เอกสารล่าสุด</div>
		<div class="list">
			<?php
			foreach ($files as $data)
				include 'template/file.items.php';
			?>
		</div>
		<?php }else{?>
		<div class="starter">
			<p>คุณยังไม่เคยอัพโหลดเอกสารใดๆ</p>
			<a href="create/choose"><i class="fa fa-plus" aria-hidden="true"></i>อัพโหลด</a>
		</div>
		<?php }?>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
