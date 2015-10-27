<h1>Category追加</h1>

<p><?php echo $this->Html->link('戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>

<?php
echo $this->Form->create('Category');
echo $this->Form->input('name');
echo $this->Form->end('Category追加');
?>