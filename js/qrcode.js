$(document).ready(function(){
	$btnQRCode 		= $('#btn-qrcode');
	$QRCodeDialog 	= $('#qrcode-dialog');
	$btnClose 		= $QRCodeDialog.children('.control').children('.btn-close');

	if(window.location.hash == '#qrcode'){
		$overlay.addClass('open');
		$QRCodeDialog.addClass('open');
	}

	$btnQRCode.click(function(){
		$overlay.addClass('open');
		$QRCodeDialog.addClass('open');
	});

	$btnClose.click(function(){
		$overlay.removeClass('open');
		$QRCodeDialog.removeClass('open');
	});
});