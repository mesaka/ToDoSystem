<h1>お問い合わせフォーム</h1>

<?php echo $this->Form->create('Contact', array('action' => 'confirm')); ?>
<?php echo $this->Form->input('name'); ?>
<?php echo $this->Form->input('from'); ?>
<?php echo $this->Form->input('to'); ?>
<?php echo $this->Form->input('subject'); ?>
<?php echo $this->Form->input('message'); ?>
<?php echo $this->Form->end('確認画面へ'); ?>