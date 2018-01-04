<?php
require_once 'autoload.php';
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

<title>บัญชือยู่ระหว่างยืนยันตัวตน</title>
<base href="<?php echo DOMAIN;?>">
<!-- CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>
<body>
<div class="logout">
	<h2>รอยันยืนตัวตน</h2>
	<p>บัญชีของคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> ลงทเีบยนเมื่อ <?php echo $user->register_time;?> ขณะนี้อยู่ในขั้นตอนการยืนยันตัวตนจากผู้ดูแลระบบ หากเราใช้เวลามากกว่า 24 ชั่วโมง สามารถติดต่อเบอร์ภายในหมายเลข <strong>3148</strong> หรือ <strong>3149</strong></p>
	<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
</div>
</body>
</html>