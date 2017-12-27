<?php
require_once 'autoload.php';
if($user_online){
	header('Location: index.php');
	die();
}

$signature 	= new Signature;
$currentPage = 'login';
?>

<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php
$p_title 	= 'เข้าสู่ระบบ '.TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN.'/signin';
?>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $p_desc;?>"/>
<meta property="og:title" content="<?php echo $p_title;?>"/>
<meta property="og:description" content="<?php echo $p_desc;?>"/>
<meta property="og:url" content="<?php echo $p_url;?>"/>
<meta property="og:image" content="<?php echo OGIMAGE;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo SITENAME;?>"/>
<meta property="fb:app_id" content="<?php echo APP_ID;?>"/>
<meta property="fb:admins" content="<?php echo ADMIN_ID;?>"/>

<meta itemprop="name" content="<?php echo $p_title;?>">
<meta itemprop="description" content="<?php echo $p_desc;?>">
<meta itemprop="image" content="<?php echo OGIMAGE;?>">

<title><?php echo $p_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<div class="login">
	<div class="welcome">
		<a href="index.php" class="logo"><img src="image/logo.png" alt=""></a>
		<h1>โรงพยาบาลเจ้าพระยาอภัยภูเบศร</h1>
		<p>Create, share and edit text documents with online word processing</p>
		<a href="index.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><span>กลับหน้าแรก</span></a>
	</div>
	<div class="content">
		<div class="nav">
			<a class="<?php echo ($currentPage=='login'?'active':'');?>" href="signin?<?php echo (!empty($_GET['redirect'])?'redirect='.$_GET['redirect']:'');?>"><i class="fa fa-sign-in" aria-hidden="true"></i>เข้าระบบ</a>
			<a class="<?php echo ($currentPage=='register'?'active':'');?>" href="signup?<?php echo (!empty($_GET['redirect'])?'redirect='.$_GET['redirect']:'');?>"><i class="fa fa-user-plus" aria-hidden="true"></i>ลงทะเบียนใหม่</a>
		</div>
		<button class="btn btn-facebook" onclick="javascript:facebookLogin();"><i class="fa fa-facebook" aria-hidden="true"></i>เข้าระบบด้วย Facebook</button>
		<div class="line"><span>หรือ</span></div>
		<form action="javascript:login();">
			<input type="phone" class="inputtext" id="username" placeholder="ที่อยู่อีเมล หรือ เบอร์โทรศัพท์" required autofocus>
			<input type="password" class="inputtext" id="password" placeholder="รหัสผ่าน" required>
			<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('login',SECRET_KEY);?>">
			<input type="hidden" id="redirect" value="<?php echo $_GET['redirect'];?>">
			<button type="btn" class="btn btn-submit" id="btnSubmit">เข้าสู่ระบบ<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
		</form>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript">
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
	FB.init({
		appId      : '<?php echo APP_ID;?>',
		cookie     : true,
		xfbml      : true,
		version    : '<?php echo GRAPH_VERSION;?>'
	});

	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			console.log('connected');
			FB.api('/me','get', {fields: 'id,name,about,birthday,email,gender,hometown,first_name,last_name,link,verified'}, function(response) { loginProgress(response); });
		}else{
			console.log('Please log into this app.');
		}
	});
};

function facebookLogin() {
	FB.login(function(){
		FB.api('/me','get', {fields: 'id,name,about,birthday,email,gender,hometown,first_name,last_name,link,verified'}, function(response) { loginProgress(response); });
		console.log('progress...');
	}, {scope: 'email'});
}
</script>
</body>
</html>