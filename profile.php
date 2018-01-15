<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
}

$document 	= new Document();
$files 		= $document->listAll(NULL,$user->id,NULL);
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

<title>เอกสารทั้งหมด</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<header class="header shadow">
	<a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><span>หน้าแรก</span></a>
	<div class="title">เอกสารทั้งหมดของคุณ</div>

	<?php include 'template/header.profile.php'; ?>
</header>

<div class="container nomargin">
	<?php if(count($dataset) > 0){?>
	<?php foreach ($dataset as $var){?>
	<div class="date"><?php echo $var['date'];?></div>
	<div class="list">
		<?php
		foreach ($var['items'] as $data){ include 'template/file.items.php'; }
		?>
	</div>
	<?php }?>
	<?php }else{?>
	<div class="starter">
		<p>คุณยังไม่เคยอัพโหลดเอกสารใดๆ</p>
		<a href="create/choose">อัพโหลดไฟล์</a>
	</div>
	<?php }?>
</div>

<div id="progressbar"></div>

<?php if($user_online){?>
<a class="btn-create" href="create/choose"><i class="fa fa-plus" aria-hidden="true"></i></a>
<?php }?>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
