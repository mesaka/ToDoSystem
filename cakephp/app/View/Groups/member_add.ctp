<h1><?php echo $group['Group']['name'];?> メンバー追加</h1>


<?php
echo $this->Form->create('GroupsUser');
echo $this->Form->hidden('GroupsUser.group_id', array('value'=>$group['Group']['id']));
echo $this->Form->input('user_id',array('options' => $users));
echo $this->Form->end('メンバー追加');
?>

<?php echo $this->Html->link('戻る',array('action'=>'index')); ?>