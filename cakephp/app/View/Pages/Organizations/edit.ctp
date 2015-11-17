<?php echo $this->Html->link('戻る',array('action'=>'index')); ?>

<h1>組織編集</h1>

<?php
echo $this->Form->create('Organization');
echo $this->Form->input('name');
echo $this->Form->input('group_id',array('options'=>$groups));
echo $this->Html->link('グループ新規作成', array('controller' => 'groups', 'action' =>'add'));
echo $this->Form->end('組織追加');
?>