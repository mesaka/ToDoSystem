<div class="container">
<h1>マイページ</h1>

<p>ログインユーザー名:<?php echo $this->name; ?></p>

<div class="row">

	<!-- メニュー -->
	<div class="col-md-2">
	<h3>Memu</h3>
	<ul>
		<li><?php echo $this->Html->link('Topへ', array('controller' => 'pages', 'action' =>'top')); ?></li>
		<li><?php echo $this->Html->link('カレンダー表示', array('controller' => 'tasks', 'action' =>'schedule')); ?></li>
		<li><?php echo $this->Html->link('一覧へ', array('controller' => 'tasks', 'action' =>'index')); ?></li>
		<li><?php echo $this->Html->link('グループ一覧へ', array('controller' => 'groups', 'action' =>'index')); ?></li>
		<li><?php echo $this->Html->link('Task追加', array('controller' => 'tasks', 'action' =>'add')); ?></li>
		<li><?php echo $this->Html->link('Category追加', array('controller' => 'categories', 'action' =>'add')); ?></li>
		<li><?php echo $this->Html->link('会員登録', array('controller'=>'users', 'action'=>'add')); ?></li>
		<li><?php echo $this->Html->link('ログイン', array('controller'=>'users', 'action'=>'login')); ?></li>
		<li><?php echo $this->Html->link('ログアウト', array('controller'=>'users', 'action'=>'logout')); ?></li>
		<li><?php echo $this->Html->link('マイページ', array('controller'=>'users', 'action'=>'mypage')); ?></li>
		<li><?php echo $this->Html->link('マイ組織ページ', array('controller'=>'users', 'action'=>'my_organization')); ?></li>
		<li><?php echo $this->Html->link('管理者ページ', array('controller' => 'users', 'action' =>'admin')); ?></li>
		<li><?php echo $this->Html->link('システム管理者ページ', array('controller' => 'users', 'action' =>'system_admin')); ?></li>
		<!-- カテゴリー一覧 -->
		<div class="category-menu">
			<li>Categories</li>
				<?php foreach ($categories as $category): ?>
				<li class="text-muted"><?php echo $this->Html->link($category['Category']['name'], array('controller' => 'tasks', 'action'=>'category_index',$category['Category']['id'])); ?></li>
				<?php endforeach; ?>
				<?php unset($category); ?>
		</div>
		<!-- タイトル検索 -->
		<li style="margin-top:30px;">
			<?php echo $this->Form->create('Task', array('action' => 'search_index')); ?>
			<span class="glyphicon glyphicon-search"></span><?php echo $this->Form->input('タイトル検索'); ?>
			<?php echo $this->Form->end('検索'); ?>
		</li>
	</ul>
	</div>


	<!-- タスク一覧 -->
	<div class="col-md-10">
	<h2>マイTask一覧</h2>
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