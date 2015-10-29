<?php echo $this->Html->link('ログイン画面へ',array('action'=>'login')); ?>

<div class="users form">
<h2><?php echo h(__('会員登録 Sign up')); ?></h2>
<p>下記のフォームに必要事項をご記入の上、[登録ボタン]を押してください</p>

	<div class="user_add">

		<?php 
			// フォームの開始を宣言する
		    echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data'));
		    // ユーザーネーム
		    echo $this->Form->input('username', array('maxlength' => '255', 'type' => 'text'));
		    // メールアドレス
		    echo $this->Form->input('email', array('maxlength' => '255', 'type' => 'email'));
		    // パスワード
		    echo $this->Form->input('password', array('maxlength' => '255', 'type' => 'password'));
		    // パスワード確認用
		    echo $this->Form->input('password_confirm', array('maxlength' => '255', 'type' => 'password'));

		    echo $this->Form->end(__('登録 Submit'));
		?>
	</div>
</div>