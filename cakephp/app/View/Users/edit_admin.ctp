<h1>ユーザー情報編集</h1>

<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('organization_id',array('options'=>$organizations));
echo $this->Form->input('group_id',array('options'=>$groups));
echo $this->Form->select('authority', array(0=>'未登録', 1=>'一般', 2=>'グループリーダー', 3=>'管理者', 9=>'システム管理者'));
echo $this->Form->input('created', array(
	'type' => 'datetime',
	'dateFormat' => 'YMD',
	'monthNames' =>false
));
echo $this->Form->input('modified', array(
	'type' => 'datetime',
	'dateFormat' => 'YMD',
	'monthNames' =>false
));
echo $this->Form->input('last_login', array(
	'type' => 'datetime',
	'dateFormat' => 'YMD',
	'monthNames' =>false
));
echo $this->Form->input('deleted', array('type' => 'select', 'options'=>array(0, 1)));
echo $this->Form->input('deleted_date', array(
	'type' => 'datetime',
	'dateFormat' => 'YMD',
	'monthNames' =>false
));
echo $this->Form->end('OK');
?>

<?php echo $this->Html->link('戻る',array('system_action'=>'admin')); ?>