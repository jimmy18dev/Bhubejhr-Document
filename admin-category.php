<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./signin");
	exit();
}
if ($user->type != 'admin') {
	header("Location:./permission.php");
	exit();
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

<title>ประเภทเอกส่าร</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header fixed">
	<a href="index.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
	<div class="title">ประเภทเอกส่าร</div>
</header>

<div class="container">
	<div class="section">
		<div class="list">
			 <div class="choose-items">
			 	<i class="fa fa-pencil" aria-hidden="true"></i>
			 	<input class="inputtext" id="new_category_name" type="text" placeholder="ตั้งชื่อประเภท..." autofocus>
			 	<i class="fa fa-plus-circle" aria-hidden="true" id="btnCreateCategory"></i>
			 </div>
			<?php foreach ($categories as $var) { ?>
			<a href="create/category/<?php echo $var['category_id'];?>" class="choose-items style<?php echo $var['category_id'];?>">
				<i class="fa fa-circle" aria-hidden="true"></i>
				<span class="name"><?php echo $var['category_name'];?></span>
				<div class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			</a>
			<?php }?>
		</div>
	</div>
</div>

<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/category.js"></script>
</body>
</html>