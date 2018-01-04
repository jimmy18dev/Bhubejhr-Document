var api_user = 'api/user.php';

$(document).ready(function(){
	var sign 		= $('#sign').val();
	$progressbar 	= $('#progressbar');
	$btnSubmit 		= $('#btnSubmit');
});

function login(){
	var username 	= $('#username').val();
	var password 	= $('#password').val();
	var sign 		= $('#sign').val();

	if(username == ''){
		$('#username').focus();
		return false;
	}else if(password == ''){
		alert('คุณยังไม่ได้กรอกรหัสผ่าน!');
		$('#password').focus();
		return false;
	}

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'70%'},500);

	$.get({
		url         :api_user,
		timeout 	:10000, //10 second timeout
		cache       :false,
		dataType    :"json",
		type        :"POST",
		data:{
			request     :'login',
			username 	:username,
			password 	:password,
			sign 		:sign,
		},
		error: function (request, status, error) {
			console.log("Request Error",request.responseText);
		}
	}).done(function(data){
		console.log(data);

		if(data.state == 1){
			$btnSubmit.addClass('loading');
			$btnSubmit.html('กำลังเข้าระบบ<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
			$progressbar.animate({width:'100%'},500);

			var redirect 	= $('#redirect').val();

			setTimeout(function(){
	        	if(redirect != ''){
	        		window.location = 'document/'+redirect;
	        	}else{
	        		window.location = 'index.php?login=success';
	        	}
	        },1000);

		}else if(data.state == 0){
			$progressbar.animate({width:'0%'},500);
			alert('เข้าระบบไม่สำเร็จ กรุณาตรวจสอบอีกครั้ง!');
		}else if(data.state == -1){
			$progressbar.animate({width:'0%'},500);
			alert('คุณต้องรออีก 5 นาที เพื่อเข้าระบบใหม่!');
		}
	}).fail(function() {
		alert('ระบบทำงานผิดพลาด กรุณาลองใหม่อีกครั้ง!');
		$progressbar.animate({width:'0%'},500);
		$('#password').focus();
		$('#password').val('');
	});
}

function register(){
	var fullname 	= $('#fullname').val();
	var email 	= $('#email').val();
	var phone 	= $('#phone').val();
	var password 	= $('#password').val();
	var sign 		= $('#sign').val();

	if(fullname == '' || phone == '' || email == '' || password == '') return false;

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'70%'},500);

	$.get({
		url         :api_user,
		timeout 	:10000, //10 second timeout
		cache       :false,
		dataType    :"json",
		type        :"POST",
		data:{
			request     :'register',
			fullname 	:fullname,
			phone 		:phone,
			email		:email,
			password 	:password,
			sign 		:sign,
		},
		error: function (request, status, error) {
			console.log("Request Error",request.responseText);
		}
	}).done(function(data){
		console.log(data);
		$btnSubmit.addClass('loading');
		$btnSubmit.html('กำลังลงทะเบียน<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

		$progressbar.animate({width:'100%'},500);

		var redirect 	= $('#redirect').val();

		setTimeout(function(){
			if(redirect != ''){
				window.location = 'document/'+redirect;
	        }else{
	        	window.location = 'index.php?login=success';
	        }
	    },1000);
	    
	}).fail(function() {
		alert('ระบบทำงานผิดพลาด กรุณาลองใหม่อีกครั้ง!');
	});
}

function loginProgress(response){
	var xhr = new XMLHttpRequest();

	console.log(response,response.id,response.email)

	if(response.id === undefined || response.id == ''){
		location.reload();
		return false;
	}

	xhr.open('POST','api/user.php', true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200){
			location.reload();
		}
	}
	xhr.send('request=facebook_login&fb_id='+response.id+'&fb_fname='+response.first_name+'&fb_lname='+response.last_name+'&fb_email='+response.email+'&fb_link='+response.link+'&fb_verified='+response.verified+'&gender='+response.gender+'');
}