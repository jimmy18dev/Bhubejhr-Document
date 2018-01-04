<?php
require_once 'autoload.php';

$category_id = $_GET['id'];

if(empty($category_id)){
	header('Location: 404!'); die();
}

$document = new Document();
$category = new Category();
$category->get($category_id);

if(empty($category->id)){
	header('Location: 404!'); die();
}

$files = $document->listAll($category->id,NULL,NULL);
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
$p_title 	= $category->name.' '.TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN.'/category/'.$category->id;
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

<header class="header shadow">
	<a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>หน้าแรก</a>
	<div class="title"><?php echo $category->name;?></div>
</header>
<div class="container nomargin">
	<div class="topic"><?php echo count($files);?> รายการ</div>
	<div class="list">
		<?php
		if(count($files) > 0){
			foreach ($files as $data)
				include 'template/file.items.php';
		}else
			include 'template/empty.items.php';
		?>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
