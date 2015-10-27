<h1>Task編集</h1>

<?php
echo $this->Form->create('Task');
echo $this->Form->input('title');
echo $this->Form->input('contents', array('rows' => '3'));
echo $this->Form->input('group_id',array('options'=>$groups));
echo $this->Form->input('deadline_date', array(
	'type' => 'date',
	'dateFormat' => 'YMD',
	'monthNames' =>false
));
echo $this->Form->input('deadline_time', array(
	'type' => 'time',
	'interval' => 5,
));
echo $this->Form->select('public_private', array(0=>'公開', 1=>'非公開'));
echo $this->Form->end('編集完了');
?>