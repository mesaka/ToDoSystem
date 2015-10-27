<h1>システム管理者ページ</h1>


<p><?php echo $this->Html->link('組織一覧へ', array('controller' => 'organizations', 'action' =>'index')); ?></p>

<p><?php echo $this->Html->link('全タスク一覧へ', array('action' =>'tasks_admin')); ?></p>

<p><?php echo $this->Html->link('ユーザー情報一覧へ', array('action' =>'users_admin')); ?></p>

<p><?php echo $this->Html->link('戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>