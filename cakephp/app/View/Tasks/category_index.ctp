<div class="container">
<h1>To Do 管理アプリ</h1>

<p>ログインユーザー名:<?php echo $this->name; ?></p>

<div class="row">

	<?php echo $this->element('sidebar'); ?>

	<!-- タスク一覧 -->
	<div class="col-md-10">
	<h2>Task一覧</h2>
	<table class="table">
	    <tr>
	    	<th>
	    		ID
	        	<?php echo $this->Html->link('△', array('controller' => 'tasks', 'action' =>'id_asc')); ?>   <!-- id昇順 -->
	        	<?php echo $this->Html->link('▽', array('controller' => 'tasks', 'action' =>'id_desc')); ?>  <!-- id降順 -->
	    	</th>
	        <th>タイトル</th>
	        <th>ユーザー</th>
	        <th>グループ</th>
	        <th>
	        	カテゴリー
	        	<?php echo $this->Html->link('△', array('controller' => 'tasks', 'action' =>'category_asc')); ?>   <!-- カテゴリー昇順 -->
	        	<?php echo $this->Html->link('▽', array('controller' => 'tasks', 'action' =>'category_desc')); ?>  <!-- カテゴリー降順 -->
	        </th>
	        <th>
	        	締め切り日時
	        	<?php echo $this->Html->link('△', array('controller' => 'tasks', 'action' =>'deadline_asc')); ?>   <!-- 締め切り日時昇順 -->
	        	<?php echo $this->Html->link('▽', array('controller' => 'tasks', 'action' =>'deadline_desc')); ?>  <!-- 締め切り日時降順 -->
	        </th>
	        <th>締め切り時間</th>
	        <th>編集削除</th>
	    </tr>


	    <?php foreach ($tasks as $task): ?>
	    <tr>
	    	<td><?php echo $task['Task']['id']; ?></td>
	    	<td><?php echo $this->Html->link($task['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $task['Task']['id'])); ?></td>
	        <td><?php echo $task['User']['username']; ?></td>
	        <td><?php echo $task['Group']['name']; ?></td>
	        <td><?php echo $this->Html->link($task['Category']['name'], array('action' => 'category_index',$task['Category']['id'])); ?></td>
	        <td><?php echo $task['Task']['deadline_date']; ?></td>
	        <td><?php echo $task['Task']['deadline_time']; ?></td>
	        <td>
	        	<?php echo $this->Html->link('編集', array('action' => 'edit', $task['Task']['id'])); ?>
	        	<?php echo $this->Form->postLink('削除', array('action' => 'delete', $task['Task']['id']), array('confirm' => 'Are you sure?')); ?>
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($task); ?>
	</table>
	</div>
</div>
</div>