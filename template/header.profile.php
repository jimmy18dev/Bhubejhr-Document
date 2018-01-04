<div class="btn-profile" id="btnProfile">
		<span class="avatar"><img src="image/avatar.png"></span>
		<span class="name"><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></span>
		<span class="icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span>

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

			<a href="signout" class="btn-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>ออกจากระบบ</a>

			<?php if($user->type == 'admin'){?>
			<div class="caption">ผู้ดูแลระบบ</div>
			<a href="admin/member"><i class="fa fa-user" aria-hidden="true"></i>รายชื่อผู้ใช้ <?php echo ($memberPending>0?'('.$memberPending.')':'');?></a>
			<a href="admin/category"><i class="fa fa-folder" aria-hidden="true"></i>ประเภทเอกสาร</a>
			<?php }?>
		</div>
	</div>