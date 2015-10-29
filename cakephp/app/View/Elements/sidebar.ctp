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
	<li><?php echo $this->Html->link('お問い合わせ', array('controller' => 'contacts', 'action' =>'index')); ?></li>

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