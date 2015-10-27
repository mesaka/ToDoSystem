<?php echo $this->Html->link('戻る',array('action'=>'index')); ?>

<h1>Group編集</h1>

<?php
echo $this->Form->create('Group');
echo $this->Form->input('name');
echo $this->Form->input('organization_id',array('options' => $organizations));
echo $this->Form->end('グループ編集');
?>