<div class="member-items" data-id="<?php echo $data['id'];?>">
	<div class="avatar">
		<img src="image/avatar.png" alt="">
	</div>
	<div class="detail">
		<div class="name">
			<span><?php echo $data['fname'].' '.$data['lname']?></span>
			<?php if($data['status'] == 'active'){?><span class="tag">Active</span><?php }?>
			<?php if($data['verified'] == 'verified'){?><span class="tag">Verified</span><?php }?>
			<?php if($data['status'] == 'locked'){?><span class="tag lock">Locked</span><?php }?>
		</div>
		<div class="desc">
			<span><strong>ที่อยู่อีเมล</strong> <?php echo $data['email'];?></span>
			<span><strong>เบอร์ติดต่อ</strong> <?php echo $data['phone'];?></span>
			<span><strong>ลงทะเบียนเมื่อ</strong> <?php echo $data['register_time'];?></span>
			<span><?php echo $data['bio'];?></span>
		</div>

		<?php if($user->id != $data['id']){?>
		<div class="control">

			<?php if($data['verified'] != 'verified'){?>
			<button class="btnop btn-verified">เป็นเจ้าหน้าที่<i class="fa fa-check-square" aria-hidden="true"></i></button>
			<?php }?>

			<?php if($data['status'] == 'active'){?>
			<button class="btnop btn-lock">ระงับการใช้งาน<i class="fa fa-lock" aria-hidden="true"></i></button>
			<?php }else if($data['status'] == 'locked'){?>
			<button class="btnop btn-active">ปลดล็อก<i class="fa fa-unlock" aria-hidden="true"></i></button>
			<?php }else{?>
			<button class="btnop btn-active">อนุญาตใช้งาน<i class="fa fa-check" aria-hidden="true"></i></button>
			<?php }?>
		</div>
		<?php }?>
	</div>
</div>