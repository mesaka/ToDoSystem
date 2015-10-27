<h1><?php echo $group['Group']['name']; ?></h1>

<ul>
    <li>所属組織: <?php echo $group['Organization']['name']; ?></li>
    <li>作成日時: <?php echo $group['Group']['created']; ?></li>
    <li>更新日時: <?php echo $group['Group']['modified']; ?></li>

    <!-- 所属メンバー -->
    <li>所属メンバー: 
    	<?php foreach ($group['User'] as $users): ?>
    	<ul>
    		<li><?php echo $users['username']; ?></li>
    	</ul>
    	<?php endforeach; ?>
	<?php unset($users); ?>
    </li>
</ul>

<p><?php echo $this->Html->link('グループ追加', array('action' =>'edit', $group['Group']['id'])); ?></p>
<p><?php echo $this->Html->link('メンバー追加', array('action' =>'member_add', $group['Group']['id'])); ?></p>
<p><?php echo $this->Html->link('戻る', array('action' =>'index')); ?></p>