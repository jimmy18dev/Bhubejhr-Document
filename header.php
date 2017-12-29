<header class="header fixed">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>">
		<img src="image/logo.png" alt="logo">
		<div class="detail">
			<div class="name">Documents</div>
			<div class="desc">Chao Phraya Abhaibhubej Hospital</div>
		</div>
	</a>

	<?php if($user_online){?>
	<div class="btn-profile" id="btnProfile">
		<span class="avatar"><img src="image/avatar.png"></span>
		<span class="name"><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></span>

		<div class="more-menu" id="menuProfile">
			<div class="arrow-up"></div>
			<?php if($user->status != 'active'){?>
			<a href="pending"><i class="fa fa-clock-o" aria-hidden="true"></i>รอยืนยันตัวตน...</a>
			<?php }else{?>
			<a href="profile"><i class="fa fa-file-text" aria-hidden="true"></i>เอกสารของฉัน</a>
			<?php }?>
			<a href="admin-member-list.php"><i class="fa fa-user" aria-hidden="true"></i>รายชื่อผู้ใช้</a>
			<a href="signout" class="btn-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>ออกจากระบบ</a>
		</div>
	</div>
	<!-- <a href="create/choose" class="btn btn-upload"><i class="fa fa-plus" aria-hidden="true"></i><span>อัพโหลด</span></a> -->
	<?php }else{?>
	<a href="signin" class="btn btn-login">เข้าระบบ<i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<!-- <a href="search.php" class="btn btn-search"><i class="fa fa-search" aria-hidden="true"></i><span>ค้นหา</span></a> -->
</header>

<div class="overlay"></div>
<div id="progressbar"></div>