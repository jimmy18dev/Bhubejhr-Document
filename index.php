<?php
require_once 'autoload.php';

$document = new Document();
$category = new Category();

$files = $document->listAll(NULL,NULL,NULL);
$categories = $category->listAll();

$feeds = $categories;
foreach ($feeds as $k => $var) {
	$dataset = [];
	foreach ($files as $i => $val) {
		if($var['category_id'] == $val['file_category_id']){
			array_push($dataset,$val);
		}
	}

	$feeds[$k]['totalitems'] = count($dataset);

	if(count($dataset)>0)
		$feeds[$k]['dataset'] = $dataset;
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

<div class="container">
	<div class="menu">
		<a href="search.php" class="items"><i class="fa fa-search" aria-hidden="true"></i>ค้นหาไฟล์</a>
		<a href="create/choose" class="items"><i class="fa fa-plus" aria-hidden="true"></i>อัพโหลด</a>
		<a href="categories.php" class="items"><i class="fa fa-folder" aria-hidden="true"></i>หมวดหมู่</a>
	</div>
	
	<?php foreach ($feeds as $var){?>
	<?php if($var['totalitems']>0){?>
	<div class="section">
		<div class="topic"><a href="category/<?php echo $var['category_id'];?>"><?php echo $var['category_name'];?></a></div>
		<div class="list">
			<?php
			if($var['totalitems']>0){
				foreach ($var['dataset'] as $data)
					include 'template/file.items.php';
			}else{ include 'template/empty.items.php'; }
			?>
		</div>
	</div>
	<?php }?>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
