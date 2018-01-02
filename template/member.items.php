<div class="member-items" data-id="<?php echo $data['id'];?>">
	<div class="avatar">
		<img src="image/avatar.png" alt="">
	</div>
	<div class="detail">
		<div class="name"><?php echo $data['fname'].' '.$data['lname']?></div>
		<div class="desc">
			<span><strong>Email:</strong> <?php echo $data['email'];?></span>
			<span><strong>Phone:</strong> <?php echo $data['phone'];?></span>
			<span><strong>Register:</strong> <?php echo $data['register_time'];?></span>
		</div>

		<?php if($user->id != $data['id']){?>
		<div class="control">
			<?php if($data['status'] == 'active'){?>
			<button class="btnop btn-lock" data-op="lock">ระงับ<i class="fa fa-angle-right" aria-hidden="true"></i></button>
			<?php }else if($data['status'] == 'reject'){?>
			<button class="btnop btn-approve" data-op="approve">อนุญาตใหม่</button>
			<?php }else{?>
			<button class="btnop btn-approve" data-op="approve">อนุญาต</button>
			<button class="btnop btn-reject" data-op="reject">เพิกเฉย</button>
			<?php }?>
		</div>
		<?php }?>
	</div>
</div>