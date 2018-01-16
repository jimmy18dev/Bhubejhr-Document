<?php
require_once 'autoload.php';

if($user->verified == 'pending'){
	header("Location:".DOMAIN."/permission.php?e=EmployeeOnly");
	exit();
}else if($user->verified == 'verified'){
	header("Location:".DOMAIN."/profile");
	exit();
}
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

<title>ขอยืนตัวตนเจ้าหน้าที่</title>
<base href="<?php echo DOMAIN;?>">
<!-- CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>
<body>

<header class="header">
	<a href="profile" class="btn btn-cancel"><i class="fa fa-close" aria-hidden="true"></i><span>ยกเลิก</span></a>
</header>

<div class="form">
	<div class="head">
		<h1>ขอยืนยันตัวตนเจ้าหน้าที่</h1>
		<p>การขอยืนยันตัวตนเป็นเจ้าหน้าที่ของโรงพยาบาล คุณจำเป็นต้องกรอกข้อมูลทุกช่องหลังจากนั้นกดที่ <strong>"ส่งคำขอ"</strong> ผู้ดูแลระบบจะใช้เวลาในการตรวจสอบไม่เกิน 24 ชั่วโมง ขอบคุณค่ะ</p>
	</div>
	<div class="form-items">
		<label for="">ชื่อนามสกุล</label>
		<input class="inputtext" type="text" id="fullname" value="<?php echo $user->fname.' '.$user->lname;?>">
	</div>
	<div class="form-items">
		<label for="">เบอร์โทรศัพท์</label>
		<input class="inputtext" type="text" id="phone" value="<?php echo $user->phone;?>">
	</div>
	<div class="form-items">
		<label for="">ที่อยู่อีเมล</label>
		<input class="inputtext" type="text" id="email" value="<?php echo $user->email;?>">
	</div>

	<div class="form-items">
		<label for="">ตำแหน่ง</label>
		<input class="inputtext" type="text" id="bio" value="<?php echo $user->bio;?>">
	</div>
	<div class="form-items">
	    <button id="btnVerify" class="fullsize">ส่งคำขอ</button>
	</div>
</div>

<div class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>