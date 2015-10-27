<?php echo $this->Html->link('戻る',array('action'=>'index')); ?>

<h1>組織追加</h1>

<?php
echo $this->Form->create('Organization');
echo $this->Form->input('name');
echo $this->Form->end('組織追加');
?>