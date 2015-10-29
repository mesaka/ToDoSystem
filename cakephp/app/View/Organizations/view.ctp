<h1><?php echo $organization['Organization']['name']; ?></h1>


<!-- グループリスト -->
グループ: 
<ul>
	<?php foreach ($organization['Group'] as $groups): ?> 
    <li><?php echo $this->Html->link($groups['name'], array('controller' => 'groups', 'action' => 'view', $groups['id'])); ?></li>
    <?php endforeach; ?>
    <?php unset($groups); ?>
</ul>

<!-- メンバーリスト -->
メンバー: 
<ul>
    <?php foreach ($organization['User'] as $users): ?>
    <li><?php echo h($users['username']); ?></li>
   	<?php endforeach; ?>
    <?php unset($users); ?>
</ul>

<p>作成日時: <?php echo h($organization['Organization']['created']); ?></p>
<p>更新日時: <?php echo h($organization['Organization']['modified']); ?><p>

<p><?php echo $this->Html->link('グループ新規作成', array('controller' => 'groups', 'action' =>'add', $organization['Organization']['id'])); ?></p>
<p><?php echo $this->Html->link('既存のグループを追加', array('action' =>'edit', $organization['Organization']['id'])); ?></p>
<p><?php echo $this->Html->link('戻る', array('action' =>'index')); ?></p>