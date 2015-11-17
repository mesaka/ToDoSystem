<div class="container">
<?php echo $this->Html->link('戻る', array('action' => 'index')); ?>

<h2 style="margin-bottom:20px;">グループ追加</h2>

<?php echo $this->Form->create('Group'); ?>
<div class="form-group"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'グループ名', 'style' => 'width:250px;')); ?></div>
<?php echo $this->Form->hidden('user_id', array('value' => $userSession['id'])); ?>
<?php echo $this->Form->end(array('label' => 'グループ追加', 'class' => 'btn btn-success')); ?>
</div>