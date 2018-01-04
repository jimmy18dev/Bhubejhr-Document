var api_category = 'api/category.php';

$(document).ready(function(){
	$categoryFormDialog = $('#categoryFormDialog');
	$btnCloseCategoryForm = $('#btnCloseCategoryForm');

	$btnSaveCategory = $('#btnSaveCategory');
	$btnDeleteCategory = $('#btnDeleteCategory');
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


	$('.btn-edit-category').click(function(){
		var category_id = $(this).parent().attr('data-id');

		$.get({
			url         :api_category,
			cache       :false,
			dataType    :"json",
			type        :"GET",
			data:{
				request:'get',
				category_id:category_id
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);

			$('#category_id').val(data.dataset.id);
			$('#category_name').val(data.dataset.name);

			$overlay.addClass('open');
			$categoryFormDialog.addClass('open');
		});
	});

	$btnCloseCategoryForm.click(function(){
		$overlay.removeClass('open');
		$categoryFormDialog.removeClass('open');
		$('#category_id').val('');
		$('#category_name').val('');
	});

	$btnSaveCategory.click(function(){
		var category_id = $('#category_id').val();
		var category_name = $('#category_name').val();

		if(!category_id || !category_name) return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);
		$btnSaveCategory.html('กำลังแก้ไข...');

		$.get({
			url         :api_category,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request:'edit',
				category_id :category_id,
				category_name :category_name
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

	$btnDeleteCategory.click(function(){
		var category_id = $('#category_id').val();
		var category_name = $('#category_name').val();

		if(!category_id || !category_name) return false;
		if(!confirm('คุณต้องการลบ "'+category_name+'"ใช่หรือไม่ ?')){ return false; }

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);
		$btnDeleteCategory.html('รอสักครู่...');

		$.get({
			url         :api_category,
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request:'delete',
				category_id :category_id
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