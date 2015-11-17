<?php echo $this->Html->link('戻る',array('action'=>'admin')); ?>

<h1>ユーザー情報編集</h1>

<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('organization_id',array('options'=>$organizations));
echo $this->Form->input('group_id',array('options'=>$groups));
echo $this->Form->select('authority', array(0=>'未登録', 1=>'一般', 2=>'グループリーダー'));
echo $this->Form->end('OK');
?>

<?php echo $this->Html->link('戻る',array('action'=>'admin')); ?>