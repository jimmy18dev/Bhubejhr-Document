<?php
require_once 'autoload.php';
$e = $_GET['e'];
?>
<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title>พบปัญหาในการเข้าถึงเอกสาร!</title>
<base href="<?php echo DOMAIN;?>">
<!-- CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>
<body>
<div class="logout">
	<?php if($e == 'EmployeeOnly'){?>
		<?php if($user->verified == 'pending'){?>
			<h2>ขอยืนยันตัวตนแล้ว</h2>
			<p>บัญชีของคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> อยู่ระหว่างการตรวจสอบตัวตนเป็นเจ้าหน้าที่ของโรงพยาบาล หากคุณรอนานมากกว่า 24 ชั่วโมงแล้ว กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong> ขอบคุณค่ะ</p>
			<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
		<?php }else{?>
			<h2>สำหรับเจ้าหน้าที่เท่านั้น!</h2>
			<p>ไฟล์เอกสารนี้อนุญาตสำหรับเจ้าหน้าที่เท่านั้น บัญชีของคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> จึงไม่สามารถเข้าถึงไฟล์นี้ได้ หากคุณเป็นเจ้าหน้าที่ของโรงพยาบาล กรุณาส่งคำขอยืนยันตัวตนเจ้าหน้าที่ได้จากปุ่มด้านล่างนี้ ขออภัยในความไม่สะดวก ขอบคุณค่ะ</p>
			<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
			<a href="verify.php" class="right">ขอยืนยันตัวตน<i class="fa fa-angle-right" aria-hidden="true"></i></a>
		<?php }?>
	<?php }else if($e == 'UserNotActive'){?>
		<h2>รอตรวจสอบบัญชี!</h2>
		<p>บัญชีของคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> อยู่ในขั้นตอนการตรวจสอบความถูกต้องจากผู้ดูแลระบบ หากคุณรอนานมากกว่า 24 ชั่วโมงแล้ว กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong> ขอบคุณค่ะ</p>

		<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
	<?php }else if($e == 'NotOwner'){?>
		<h2>คุณไม่ใช่เจ้าของเอกสาร!</h2>
		<p>เราพบว่าคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> ไม่ใช่เจ้าของเอกสารดังกล่าว จึงไม่มีสิทธิ์ในแก้ไขหรือลบเอกสารได้ หากคุณแน่ใจว่าเป็นเจ้าของเอกสารจริง กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong> ขอบคุณค่ะ</p>

		<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
	<?php }?>
</div>
</body>
</html>