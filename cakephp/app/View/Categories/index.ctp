<div class="container">
<h1>Task一覧</h1>
<p><?php echo $this->Html->link('Category追加', array('controller' => 'categories', 'action' =>'add')); ?></p>
<p><?php echo $this->Html->link('Task一覧', array('controller' => 'tasks', 'action' =>'index')); ?></p>

<table class="table">
    <tr>
        <th>Id</th>
        <th>ユーザー</th>
        <th>カテゴリー名</th>
        <th>作成日時</th>
        <th>更新日時</th>
        <th>編集・削除</th>
    </tr>


    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo h($category['Category']['id']); ?></td>
        <td><?php echo h($category['Category']['user_id']); ?></td>
        <td><?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?></td>
        <td><?php echo h($category['Category']['created']); ?></td>
        <td><?php echo h($category['Category']['modified']); ?></td>
        <td><?php echo $this->Html->link('編集', array('action' => 'edit', $category['Category']['id'])); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>
</div>