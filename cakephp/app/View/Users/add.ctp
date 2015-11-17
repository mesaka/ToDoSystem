<div class="container">

<div class="users form">
<h2><?php echo h(__('会員登録 Sign up')); ?></h2>
<p>下記のフォームに必要事項をご記入の上、[登録ボタン]を押してください</p>

	<div class="user_add">
		<div class="form-group"><?php echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data')); ?></div>
		<!-- ユーザーネーム -->
		<?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'お名前', 'maxlength' => '255', 'type' => 'text', 'style' => 'width:600px')); ?>
		<!-- メールアドレス -->
		<?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'メールアドレス', 'maxlength' => '255', 'type' => 'email', 'style' => 'width:600px')); ?>
		<!-- パスワード -->
		<?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'パスワード', 'maxlength' => '255', 'type' => 'password', 'style' => 'width:600px')); ?>
		<!-- パスワード確認用 -->
		<?php echo $this->Form->input('password_confirm', array('class' => 'form-control', 'label' => 'パスワード確認用', 'maxlength' => '255', 'type' => 'password', 'style' => 'width:600px')); ?>

		<?php echo $this->Form->end(array('label' => '登録', 'class' => 'btn btn-success', 'style' => 'margin-top:20px')); ?>
	</div>
	
</div>
</div>