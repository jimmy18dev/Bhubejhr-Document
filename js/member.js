var api_member = 'api/member.php';

$(document).ready(function(){

	$('.btn-active').click(function(){
		var member_id = $(this).parent().parent().parent().attr('data-id');
		if(!member_id)
			return false;

		if(!confirm('คุณต้องการบัญชีนี้ ใช่หรือไม่ ?')){ return false; }

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.get({
			url         :api_member,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'active',
				member_id 	:member_id
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);

			$progressbar.animate({width:'100%'},200);

			setTimeout(function(){
				location.reload();
		    },1000);
		});
	});

	$('.btn-verified').click(function(){
		var member_id = $(this).parent().parent().parent().attr('data-id');
		if(!member_id)
			return false;

		if(!confirm('คุณต้องการบัญชีนี้ ใช่หรือไม่ ?')){ return false; }

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.get({
			url         :api_member,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'verified',
				member_id 	:member_id
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);

			$progressbar.animate({width:'100%'},200);

			setTimeout(function(){
				location.reload();
		    },1000);
		});
	});

	$('.btn-lock').click(function(){
		var member_id = $(this).parent().parent().parent().attr('data-id');
		if(!member_id)
			return false;

		if(!confirm('คุณต้องการบัญชีนี้ ใช่หรือไม่ ?')){ return false; }

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.get({
			url         :api_member,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'lock',
				member_id 	:member_id
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);

			$progressbar.animate({width:'100%'},200);

			setTimeout(function(){
				location.reload();
		    },1000);
		});
	});
});