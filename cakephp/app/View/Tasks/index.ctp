<div class="container">
<h1>To Do 管理アプリ</h1>

<p>ログインユーザー名:<?php echo h($this->name); ?></p>

<div class="row">

	<?php echo $this->element('sidebar'); ?>

	<!-- タスク一覧 -->
	<div class="col-md-10">
	<h2>Task一覧</h2>
	<table class="table">
	    <tr>
	    	<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
	        <th>タイトル</th>
	        <th>ユーザー</th>
	        <th>グループ</th>
	        <th><?php echo $this->Paginator->sort('Category.name', 'カテゴリー'); ?></th>
	        <th><?php echo $this->Paginator->sort('deadline_date', '締め切り日時'); ?></th>
	        <th>編集削除</th>
	    </tr>


	    <?php foreach ($tasks as $task): ?>
	    <tr>
	    	<td><?php echo h($task['Task']['id']); ?></td>
	    	<td><?php echo $this->Html->link($task['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $task['Task']['id'])); ?></td>
	        <td><?php echo h($task['User']['username']); ?></td>
	        <td><?php echo h($task['Group']['name']); ?></td>
	        <td><?php echo $this->Html->link($task['Category']['name'], array('action' => 'category_index',$task['Category']['id'])); ?></td>
			<?php $deadline_time = date('H:i', strtotime($task['Task']['deadline_time'])) ?>   <!-- 時間を秒なしに変換 -->
	        <td><?php echo h($task['Task']['deadline_date'].' '.$deadline_time); ?></td>
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