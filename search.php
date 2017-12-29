<?php
require_once 'autoload.php';

$document = new Document();
$category = new Category();
$keyword = new Keyword();

$q = $_GET['q'];

$category->get($_GET['id']);

if(!empty($q) && isset($q)){
	$keyword->save($q);
	$files = $document->listAll($category->id,NULL,$q);
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

<title>ค้นหาเอกสาร</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header light">
	<a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>หน้าแรก</a>
</header>

<form class="search-form" action="search.php" method="GET">
	<div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
	<input type="text" name="q" id="searchInput" class="inputtext" placeholder="ค้นหาเอกสาร" autofocus value="<?php echo $q;?>">
	<div class="tip" id="tip">กด Enter เพิ่มค้นหา</div>
</form>
<div class="container">
	<div class="section">
		<?php if(count($files) > 0){?>
		<div class="topic">พบ <?php echo count($files);?> รายการ</div>
		<div class="list">
			<?php
			if(count($files) > 0){
				foreach ($files as $data)
					include 'template/file.items.php';
			}
			?>
		</div>
		<?php }else if(!empty($q)){?>
		<div class="starter">
			<p>ไม่พบเอกสารที่เกี่ยวกับ "<?php echo $q;?>"</p>
		</div>
		<?php }?>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
