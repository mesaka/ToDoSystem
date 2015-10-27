<h1>グループ一覧</h1>
<p><?php echo $this->Html->link('タスク一覧へ戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>
<p><?php echo $this->Html->link('追加', array('controller' => 'groups', 'action' =>'add')); ?></p>

<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>organization</th>
        <th>created</th>
        <th>modified</th>
        <th>actions</th>
    </tr>



    <?php foreach ($groups as $group): ?>
    <tr>
        <td><?php echo $group['Group']['id']; ?></td>
        <td><?php echo $this->Html->link($group['Group']['name'], array('action' => 'view', $group['Group']['id'])); ?></td>
        <td><?php echo $group['Organization']['name']; ?></td>
        <td><?php echo $group['Group']['created']; ?></td>
        <td><?php echo $group['Group']['modified']; ?></td>
        <td>
            <?php echo $this->Html->link('編集',array('action'=>'edit',$group['Group']['id']));?>
            <?php echo $this->Form->postLink('削除', array('action' => 'delete', $group['Group']['id']), array('confirm' => 'Are you sure?')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($group); ?>
</table>