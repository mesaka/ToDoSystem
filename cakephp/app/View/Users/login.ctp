<div class="container">

<div class="go-newuser"><p><?php echo $this->Html->link("新規会員登録はこちら", array('action' => 'add')); ?></p></div>


<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
    <legend><?php echo h(__('ログイン画面')); ?></legend>
	    <div class="form-group"><?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'メールアドレス', 'maxlength' => '255', 'type' => 'text', 'style' => 'width:50%;')); ?></div>
	    <div class="form-group"><?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'パスワード', 'maxlength' => '255', 'type' => 'password', 'style' => 'width:50%;')); ?></div>
    </fieldset>
<?php echo $this->Form->end(array('label' => 'ログイン', 'class' => 'btn btn-success')); ?>

</div>