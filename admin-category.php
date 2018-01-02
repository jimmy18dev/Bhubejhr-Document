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

<header class="header shadow">
	<a href="index.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
	<div class="title">ประเภทเอกส่าร</div>
</header>

<div class="container nomargin">
	<div class="list">
		<div class="choose-items">
			<div class="icon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
			<div class="name">
				<input class="inputtext" id="new_category_name" type="text" placeholder="ตั้งชื่อประเภท..." autofocus>
			</div>
			<div class="control"><i class="fa fa-plus-circle" aria-hidden="true" id="btnCreateCategory"></i></div>
		</div>

		<?php foreach ($categories as $var) { ?>
		<div class="choose-items style<?php echo $var['category_id'];?>" data-id="<?php echo $var['category_id'];?>">
			<div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
			<span class="name"><?php echo $var['category_name'];?></span>
			<div class="control btn-edit-category">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			</div>
		</div>
		<?php }?>
	</div>
</div>

<div class="dialog" id="categoryFormDialog">
	<div class="head">
		<div class="text">แก้ไข</div>
		<div class="btn" id="btnCloseCategoryForm"><i class="fa fa-close" aria-hidden="true"></i></div>
	</div>
	<div class="content">
		<label for="category_name">ชื่อประเภทเอกสาร</label>
		<input type="text" class="inputtext" id="category_name">
		<input type="hidden" id="category_id">
	</div>
	<div class="control">
		<button id="btnDeleteCategory" class="btn delete">ลบรายการนี้</button>
		<button id="btnSaveCategory" class="btn save"><i class="fa fa-check" aria-hidden="true"></i>บันทึก</button>
	</div>
</div>

<div id="progressbar"></div>
<div class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/category.js"></script>
</body>
</html>