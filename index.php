<?php
require_once 'autoload.php';

$document = new Document();
$category = new Category();

$files = $document->listAll(NULL,NULL,NULL);
$categories = $category->listAll();

$feeds = $categories;
foreach ($feeds as $k => $var) {
	$dataset = [];
	foreach ($files as $i => $val) {
		if($var['category_id'] == $val['file_category_id']){
			array_push($dataset,$val);
		}
	}

	$feeds[$k]['totalitems'] = count($dataset);

	if(count($dataset)>0)
		$feeds[$k]['dataset'] = $dataset;
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php include'favicon.php';?>
<title><?php echo $page_title;?></title>

<?php
$p_title 	= TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN;
?>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $p_desc;?>"/>
<meta property="og:title" content="<?php echo $p_title;?>"/>
<meta property="og:description" content="<?php echo $p_desc;?>"/>
<meta property="og:url" content="<?php echo DOMAIN;?>"/>
<meta property="og:image" content="<?php echo OGIMAGE;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo SITENAME;?>"/>
<meta property="fb:app_id" content="<?php echo APP_ID;?>"/>
<meta property="fb:admins" content="<?php echo ADMIN_ID;?>"/>

<meta itemprop="name" content="<?php echo $p_title;?>">
<meta itemprop="description" content="<?php echo $p_desc;?>">
<meta itemprop="image" content="<?php echo OGIMAGE;?>">

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<?php include_once 'header.php';?>

<div class="container">
	<?php foreach ($feeds as $var){?>
	<?php if($var['totalitems']>0){?>
	<div class="section">
		<div class="topic"><a href="category/<?php echo $var['category_id'];?>"><?php echo $var['category_name'];?></a></div>
		<div class="list shadow">
			<?php
			if($var['totalitems']>0){
				foreach ($var['dataset'] as $data)
					include 'template/file.items.php';
			}else{ include 'template/empty.items.php'; }
			?>
		</div>
	</div>
	<?php }?>
	<?php }?>
</div>


<?php if(false){?>
<table class="list">
	<?php foreach ($files as $var){?>
	<tr id="file<?php echo $var['file_id']?>" data-id="<?php echo $var['file_id'];?>" data-name="<?php echo $var['file_title'];?>">
		<td><?php echo $var['file_id'];?></td>
		<td>
			<?php echo $var['file_type'];?>
			<?php if($var['file_type']=='pdf'){?>
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
			<?php }else if($var['file_type']=='doc'){?>
			<i class="fa fa-file-word-o" aria-hidden="true"></i>
			<?php }else if($var['file_type']=='doc'){?>
			<i class="fa fa-file-image-o" aria-hidden="true"></i>
			<?php }else if($var['file_type']=='xlsx'){?>
			<i class="fa fa-file-excel-o" aria-hidden="true"></i>
			<?php }else{?>
			<i class="fa fa-file-o" aria-hidden="true"></i>
			<?php }?>
		</td>
		<td><?php echo $var['file_category_name'];?></td>
		<td><a href="file.php?id=<?php echo $var['file_id'];?>"><?php echo $var['file_title'];?></a></td>
		<td><img src="image/qrcode/<?php echo $var['file_name'];?>.png"></td>
		<td>
			<select class="selecting">
				<option <?php echo ($var['file_privacy']=='public'?'selected':'');?> value="public">Public</option>
				<option <?php echo ($var['file_privacy']=='member'?'selected':'');?> value="member">Member</option>
				<option <?php echo ($var['file_privacy']=='onlyme'?'selected':'');?> value="onlyme">Only Me</option>
			</select>
		</td>
		<td><button class="btnDelete">Delete</button></td>
	</tr>
	<?php }?>
</table>
<?php }?>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/document.js"></script>
</body>
</html>
