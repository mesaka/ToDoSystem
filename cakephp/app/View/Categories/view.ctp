<h1>Category詳細</h1>
<p><?php echo $this->Html->link('戻る', array('controller' => 'categories', 'action' =>'index')); ?></p>

<ul>
	<li>Id: <?php echo h($category['Category']['id']); ?></li>
    <li>ユーザー: <?php echo h($category['Category']['user_id']); ?></li>
    <li>カテゴリー名: <?php echo h($category['Category']['name']); ?></li>
    <li>作成日時: <?php echo h($category['Category']['created']); ?></li>
    <li>更新日時: <?php echo h($category['Category']['modified']); ?></li>
    <li><?php echo $this->Html->link('編集', array('action' => 'edit', $category['Category']['id'])); ?></li>
</ul>