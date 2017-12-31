<header class="header fixed">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>">
		<img src="image/logo.png" alt="logo">
		<div class="detail">
			<div class="name">Documents</div>
			<div class="desc">Chao Phraya Abhaibhubej Hospital</div>
		</div>
	</a>

	<form class="search-form" action="search.php" method="GET">
		<div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
		<input type="text" name="q" class="inputtext" placeholder="ค้นหาเอกสาร" maxlength="30" autofocus value="<?php echo $q;?>">
		<div class="tip" id="tip">กด Enter เพิ่มค้นหา</div>
	</form>

	<?php if($user_online){?>
	<div class="btn-profile" id="btnProfile">
		<span class="avatar">
			<img src="image/avatar.png">
		</span>
		<span class="name"><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></span>

		<?php if($memberPending > 0){?>
		<div class="notif"><?php echo $memberPending;?></div>
		<?php }?>

		<div class="more-menu" id="menuProfile">
			<div class="arrow-up"></div>
			<?php if($user->status != 'active'){?>
			<a href="pending"><i class="fa fa-clock-o" aria-hidden="true"></i>รอยืนยันตัวตน...</a>
			<?php }else{?>
			<a href="profile"><i class="fa fa-file-text" aria-hidden="true"></i>เอกสารของฉัน</a>
			<?php }?>

			<?php if($user->type == 'admin'){?>
			<a href="admin-member-list.php"><i class="fa fa-user" aria-hidden="true"></i>รายชื่อผู้ใช้ <?php echo ($memberPending>0?'('.$memberPending.')':'');?></a>
			<a href="admin-category.php"><i class="fa fa-folder" aria-hidden="true"></i>ประเภทเอกสาร</a>
			<?php }?>

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