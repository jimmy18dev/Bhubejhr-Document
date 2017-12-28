
<?php if($data['file_privacy']!='onlyme' || $user->id == $data['file_owner_id']){?>
<?php
// Privacy
switch ($data['file_privacy']) {
	case 'public':
		$privacy = '<span title="ทุกคนเห็นไฟล์นี้"><i class="fa fa-globe" aria-hidden="true"></i></span>';
		break;
	case 'member':
		$privacy = '<span title="เห็นเฉพาะสมาชิกเท่านั้น"><i class="fa fa-user" aria-hidden="true"></i></span>';
		break;
	case 'onlyme':
		$privacy = '<span title="คุณเท่านั้นที่เห็นไฟล์นี้"><i class="fa fa-lock" aria-hidden="true"></i></span>';
		break;
	default:
		# code...
		break;
}

// Icon
switch ($data['file_type']) {
	case 'PDF':
		$icon = '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>';
		break;
	case 'Word':
		$icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
		break;
	case 'Excel':
		$icon = '<i class="fa fa-file-excel-o" aria-hidden="true"></i>';
		break;
	case 'PowerPoint':
		$icon = '<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>';
		break;
	case 'Zip':
		$icon = '<i class="fa fa-file-zip-o" aria-hidden="true"></i>';
		break;
	case 'txt':
		$icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
		break;
	default:
		$icon = '<i class="fa fa-file-o" aria-hidden="true"></i>';
		break;
}
?>

<div class="file-items">
	<a href="document/<?php echo $data['file_id']?>" class="icontype"><?php echo $icon;?></a>
	<div class="detail">
		<div class="name"><a href="document/<?php echo $data['file_id']?>"><?php echo $data['file_title']?></a></div>
		<p>
			<a href="category/<?php echo $data['file_category_id']?>" class="style<?php echo $data['file_category_id']?>"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $data['file_category_name'];?></a>
			<a href="document/<?php echo $data['file_id']?>" title="<?php echo $data['file_create_time'];?>"><?php echo $data['file_create_time_fb'];?></a>
			<span><?php echo $privacy?></span>
		</p>
	</div>
	<a class="icon" href="document/<?php echo $data['file_id']?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
</div>
<?php }?>