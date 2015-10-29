<p><?php echo $this->Html->link("会員登録へ", array('action' => 'add')); ?></p>
<!-- <p><?php// echo $this->Html->link('Top画面へ',array('controller'=>'pages', 'action'=>'top')); ?></p> -->

<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
    <legend><?php echo h(__('ログイン画面')); ?></legend>
	    <?php echo $this->Form->input('username', array('maxlength' => '255', 'type' => 'text'));
	    	echo $this->Form->input('password', array('maxlength' => '255', 'type' => 'password'));
		?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>