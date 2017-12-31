$(document).ready(function(){
	$overlay 		= $('.overlay');
	$progressbar 	= $('#progressbar');
	$btnProfile 	= $('#btnProfile');
	$menuProfile 	= $('#menuProfile');

	$(document).click(function(e) {
		var current_id = e.target.id;
		if(current_id == '' && e.target.offsetParent != null)
			current_id = e.target.offsetParent.id;
		if(current_id != 'btnProfile')
			$menuProfile.removeClass('open');
	});
	
	$btnProfile.click(function(){
		$menuProfile.addClass('open');
	});

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'100%'},500);
	$progressbar.fadeOut();

	$headerbar = $('.fixed');
	$document = $(document);

	$document.scroll(function() {
		if ($document.scrollTop() >= 10) {
			// $element.addClass(className);
			$headerbar.addClass('shadow');
			console.clear();
			console.log('$document.scrollTop()'+$document.scrollTop());
		} else {
			console.clear();
			console.log('Min');
			$headerbar.removeClass('shadow');
		}
});
});