<?php
require_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/signin');
	die();
}else if($user->status != 'active'){
	header('Location: '.DOMAIN.'/pending');
	die();
}

$category = new Category();
$categories = $category->listAll();
?>

<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title>เลือกประเภทเอกสาร</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header light">
	<!-- <a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>ยกเลิก</a> -->
	<a href="index.php" class="btn btn-cancel"><i class="fa fa-close" aria-hidden="true"></i><span>ยกเลิก</span></a>
	<div class="title">กรุณาเลือกประเภท...</div>
</header>

<div class="container">
	<div class="section">
		<div class="list">
			<?php foreach ($categories as $var) { ?>
			<a href="create/category/<?php echo $var['category_id'];?>" class="choose-items style<?php echo $var['category_id'];?>">
				<i class="fa fa-circle" aria-hidden="true"></i>
				<span class="name"><?php echo $var['category_name'];?></span>
				<div class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			</a>
			<?php }?>
		</div>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
