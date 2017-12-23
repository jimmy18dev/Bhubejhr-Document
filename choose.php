<?php
require_once 'autoload.php';

if(!$user_online){
	header('Location: login.php');
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

<header class="header">
	<a href="index.php" class="btn left"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>ยกเลิก</a>
</header>

<div class="container">
	<div class="section">
		<div class="topic">กรุณาเลือกประเภท...</div>
		<div class="list shadow">
			<?php foreach ($categories as $var) {?>
			<a href="create/category/<?php echo $var['category_id'];?>" class="choose-items"><span class="name"><?php echo $var['category_name'];?></span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<?php }?>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
