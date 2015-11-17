<h1>Top画面</h1>

<p>id: <?php echo $_SESSION['Auth']['User']['id'] ?></p>
<p>ユーザー名: <?php echo $_SESSION['Auth']['User']['username'] ?></p>
<p>created: <?php echo $_SESSION['Auth']['User']['created'] ?></p>
<p>modified: <?php echo $_SESSION['Auth']['User']['modified'] ?></p>
<p>last_login: <?php echo $_SESSION['Auth']['User']['last_login'] ?></p>
<p><?php print_r($_SESSION) ?><p>


<p><?php echo $this->Html->link('Task一覧へ',array('controller'=>'tasks', 'action'=>'index')); ?></p>
<p><?php echo $this->Html->link('戻る',array('controller'=>'users', 'action'=>'login')); ?></p>
<?php echo $this->Html->link('ログアウト',array('controller' => 'users', 'action'=>'logout')); ?>