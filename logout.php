<?php
include'autoload.php';

// Unset all session values
$_SESSION = array();

// Destroy session
unset($_COOKIE['user_id']);
unset($_SESSION['user_id']);
setcookie('user_id','');
setcookie('space_id','');

unset($_COOKIE['login_string']);
unset($_SESSION['login_string']);
unset($_SESSION['space_id']);
setcookie('login_string','');

session_destroy();

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

<title>กำลังออกจากระบบ...</title>
<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>
<body>
<div class="logout">
	<h2>กำลังออกจากระบบ</h2>
	<p>หากคุณรอนานกว่า 5 วินาที สามารถกดที่ปุ่ม "กลับไปหน้าแรก"</p>
	<a href="signin"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับไปหน้าแรก</a>
</div>
</body>

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
			FB.logout(function(response) {
				console.log(response);
				setTimeout(function(){window.location = 'signin';},1000);
			});
		} else {
			setTimeout(function(){window.location = 'signin';},1000);
		}
	});
};
</script>
</html>
