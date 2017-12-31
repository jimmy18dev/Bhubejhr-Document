var api_category = 'api/category.php';

$(document).ready(function(){
	$btnCreateCategory = $('#btnCreateCategory');

	$btnCreateCategory.click(function(){
		var name = $('#new_category_name').val();

		if(!name) return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.get({
			url         :api_category,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request:'create',
				name 	:name
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