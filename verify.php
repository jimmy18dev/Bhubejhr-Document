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
<div class="logout">
	<?php if($user->status == 'employee_verify'){?>
	<h2>ส่งคำขอแล้ว</h2>
	<p>ผู้ดูแลระบบกำลังตรวจสอบคำขอยืนยันตัวตนเจ้าหน้าที่ของคุณ หากคุณรอนานเกิน 24 ชั่วโมง กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong></p>

	<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
	<?php }else{?>
	<h2>คำขอยืนตัวตนเจ้าหน้าที่</h2>
	<p>กรุณาใส่ชื่อตำแหน่ง แผนกที่ทำงานเพื่อส่งให้ผู้ดูแลระบบตรวจสอบ</p>

	<textarea id="bio" placeholder="ใส่ตำแหน่งและแผนก..."><?php echo $user->bio;?></textarea>
	<button onclick="javascript:requestVerify();">บันทึก<i class="fa fa-check" aria-hidden="true"></i></button>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>