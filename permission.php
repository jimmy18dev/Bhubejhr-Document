<?php
require_once 'autoload.php';

if (!$user_online) {
	header("Location:./login.php");
	exit();
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

<title>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<div class="logout">
	<h2>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</h2>
	<p>บัญชีของคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> ไม่สามารถเข้าถึงหน้าที่คุณต้องการได้ หากเป็นหน้าเพจที่คุณใช้เป็นประจำ กรุณาติดต่อเบอร์ภายในหมายเลข <strong>3148</strong> หรือ <strong>3149</strong></p>
	<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
</div>
</body>
</html>
