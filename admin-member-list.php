<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
}

$document 	= new Document();
$member 	= new Member();
$files 		= $document->listAll(NULL,$user->id,NULL);
$members = $member->listAll();
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

<header class="header fixed">
	<a href="index.php" class="btn btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
	<div class="title">ผู้ใช้งาน</div>
</header>

<div class="container margintop">
	<div class="section">
		<?php if(count($members) > 0){?>
		<div class="list">
			<?php
			foreach ($members as $data)
				include 'template/member.items.php';
			?>
		</div>
		<?php }else{?>
		<div class="starter">
			<p>คุณยังไม่เคยอัพโหลดเอกสารใดๆ</p>
			<a href="create/choose"><i class="fa fa-cloud-upload" aria-hidden="true"></i>อัพโหลดไฟล์</a>
		</div>
		<?php }?>
	</div>
</div>

<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/member.js"></script>
</body>
</html>
