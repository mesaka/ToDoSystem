<div class="container">
<h1>お問い合わせフォーム</h1>

<?php echo $this->Form->create('Contact', array('action' => 'confirm')); ?>
<div class="form-group"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'お名前', 'style' => 'width:300px')); ?></div>
<div class="form-group"><?php echo $this->Form->input('from', array('class' => 'form-control', 'label' => 'メールアドレス', 'style' => 'width:300px')); ?></div>
<!-- <div class="form-group"><?php //echo $this->Form->input('to', array('class' => 'form-control', 'label' => '送信先', 'style' => 'width:300px')); ?></div> -->
<div class="form-group"><?php echo $this->Form->input('subject', array('class' => 'form-control', 'label' => '件名', 'style' => 'width:300px')); ?></div>
<div class="form-group"><?php echo $this->Form->input('message', array('class' => 'form-control', 'label' => 'お問い合わせ内容', 'style' => 'width:500px', 'rows' => '5')); ?></div>
<?php echo $this->Form->end('確認画面へ'); ?>
</div>