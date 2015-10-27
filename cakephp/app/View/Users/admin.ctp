<h1>管理者ページ</h1>
<p><?php echo $this->Html->link('戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>

<table>
	
	<tr>
		<th>id</th>
		<th>name</th>
		<th>organization</th>
		<th>group</th>
		<th>authority</th>
		<th>created</th>
		<th>modified</th>
		<th>last_login</th>
		<th>deleted</th>
		<th>deleted_date</th>
		<th>action</th>
	</tr>


<?php foreach($users as $user) :?>

	<tr>
		<td><?php echo ($user['User']['id']); ?></td>
		<td><?php echo ($user['User']['username']); ?></td>
		<td><?php echo ($user['Organization']['name']); ?></td>
		<td><?php echo ($user['Group']['name']); ?></td>
		<td><?php echo ($user['User']['authority']); ?></td>
		<td><?php echo ($user['User']['created']); ?></td>
		<td><?php echo ($user['User']['modified']); ?></td>
		<td><?php echo ($user['User']['last_login']); ?></td>
		<td><?php echo ($user['User']['deleted']); ?></td>
		<td><?php echo ($user['User']['deleted_date']); ?></td>
		<td><?php echo $this->Html->link('編集', array('action' => 'edit', $user['User']['id'])); ?></td>
	</tr>

<?php endforeach; ?>

</table>
