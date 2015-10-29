<?php // 時間を変換
// 締め切り日時
$deadline_date = $task['Task']['deadline_date'];
$tmp_deadline_date = date('Y年m月d日', strtotime($deadline_date));
// 締め切り時間
$deadline_time = $task['Task']['deadline_time'];
$tmp_deadline_time = date('H時i分', strtotime($deadline_time));
// created
$created = $task['Task']['created'];
$tmp_created = date('Y-m-d H:i', strtotime($created));
// modified
$modified = $task['Task']['modified'];
$tmp_modified = date('Y-m-d H:i', strtotime($modified));
?>

<h1><?php echo h($task['Task']['title']); ?></h1>

<h2 style="padding-top:20px;"><?php echo $this->Markdown->transform($task['Task']['contents']); ?></h2>

<ul>	
    <li>ユーザー: <?php echo h($task['User']['username']); ?></li>
    <li>カテゴリー: <?php echo h($task['Category']['name']); ?></li>
    <li>締切日付: <?php echo h($tmp_deadline_date); ?></li>
    <li>締切時間: <?php echo h($tmp_deadline_time); ?></li>
    <li>作成日時: <?php echo h($tmp_created); ?></li>
    <li>更新日時: <?php echo h($tmp_modified); ?></li>
    <li>
    	<?php echo $this->Html->link('編集', array('action' => 'edit', $task['Task']['id'])); ?>
    	<?php echo $this->Form->postLink('削除', array('action' => 'delete', $task['Task']['id']), array('confirm' => 'Are you sure?')); ?>
    </li>
</ul>

<p><?php echo $this->Html->link('戻る', array('controller' => 'tasks', 'action' =>'index')); ?></p>