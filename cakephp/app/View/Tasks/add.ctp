<h1>Task追加</h1>

<p><?php echo $this->Html->link('戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>

<?php
echo $this->Form->create('Task');
echo $this->Form->input('title');
echo $this->Form->input('contents', array('rows' => '3'));
echo $this->Form->input('category_id',array('options' => $categories));
echo $this->Form->input('group_id',array('options' => $groups));
echo $this->Form->input('deadline_date', array(
											'label' => '締め切り日',
											'type' => 'date',
											'dateFormat' => 'YMD',
											'monthNames' => false,
											'separator' => array('年', '月', '日'),
											'default' => date("Y-m-d"),
											'empty' => '---'));
echo $this->Form->input('deadline_time', array(
											'label' => '締め切り時間',
											'type' => 'time',
											'timeFormat' => '24',
											'interval' => 5,
											'default' => date("G:i"),
											'empty' => '---'));
// echo $this->Form->select('public_private', array(0 => '公開', 1 => '非公開'));
echo $this->Form->input('public_private', array(
											'label' => '公開状態',
											'type' => 'select',
											'options' => array(0 => '公開', 1 => '非公開'),
											'empty' => ''));
echo $this->Form->input('alert_switch', array( 
								    'type' => 'checkbox', 
									'checked' => true,
								    'label' => 'お知らせメールを受けとる'));
echo $this->Form->input('alert_time', array(
											'label' => 'お知らせメール時間',
											'type' => 'select',
											'options' => array(0 => '1週間前', 1 => '3日前', 2 => '1日前', 3 => '12時間前', 4 => '6時間前', 5 => '3時間前', 6 => '1時間前', 7 => '30分前', 8 => '締め切り時間'),
											'empty' => '----'));
echo $this->Form->hidden('Task.organization_id', array('value' => $organize));
echo $this->Form->end('Task追加');
?>
