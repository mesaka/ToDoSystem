<h1>組織一覧</h1>
<p><?php echo $this->Html->link('戻る', array('controller' => 'users', 'action' =>'system_admin')); ?></p>
<p><?php echo $this->Html->link('追加', array('controller' => 'organizations', 'action' =>'add')); ?></p>

<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>created</th>
        <th>modified</th>
        <th>actions</th>
    </tr>



    <?php foreach ($organizations as $organization): ?>
    <tr>
        <td><?php echo h($organization['Organization']['id']); ?></td>
        <td><?php echo $this->Html->link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
        <td><?php echo h($organization['Organization']['created']); ?></td>
        <td><?php echo h($organization['Organization']['modified']); ?></td>
        <td>
            <?php echo $this->Html->link('編集',array('action'=>'edit',$organization['Organization']['id']));?>
            <?php echo $this->Form->postLink('削除', array('action' => 'delete', $organization['Organization']['id']), array('confirm' => 'Are you sure?')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($organization); ?>
</table>