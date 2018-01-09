var api_member = 'api/member.php';

$(document).ready(function(){

	$btn = $('.btnop');

	$btn.click(function(){
		var member_id = $(this).parent().parent().parent().attr('data-id');
		var operation = $(this).attr('data-op');
		var confirmMsg = '';

		if(!member_id)
			return false;

		console.log('BTn Clickd');

		switch(operation) {
		    case 'approve':
		    	confirmMsg = 'ยอมรับ';
		    	break;
		    case 'reject':
		    	confirmMsg = 'ปฏิเสธ';
		    	break;
		    case 'lock':
		    	confirmMsg = 'ล็อก';
		    	break;
		    default:
		    	text = "n/a";
		}

		if(!confirm('คุณต้องการ'+confirmMsg+'บัญชีนี้ ใช่หรือไม่ ?')){ return false; }

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.get({
			url         :api_member,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :operation,
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