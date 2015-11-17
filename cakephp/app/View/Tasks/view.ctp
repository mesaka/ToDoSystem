<?php // 時間を変換
// 締め切り日時
if ($task['Task']['deadline_date'] === null) {
    $tmp_deadline_date = "---年---月---日";
} else {
    $deadline_date = $task['Task']['deadline_date'];
    $tmp_deadline_date = date('Y年m月d日', strtotime($deadline_date));
}

// 締め切り時間
if ($task['Task']['deadline_time'] === null) {
    $tmp_deadline_time = "---時---分";
} else {
    $deadline_time = $task['Task']['deadline_time'];
    $tmp_deadline_time = date('H時i分', strtotime($deadline_time));
}
?>
<div class="container">

<p><?php echo $this->Html->link('戻る', array('controller' => 'groups', 'action' =>'index')); ?></p>


<!-- タスク -->
<ul class="square" style="background:<?php echo $task['Task']['color']; ?>">
    <li class="task-titile"><?php echo h($task['Task']['title']); ?></li>
    <li class="task-detail">○&ensp;詳細<?php echo $this->Markdown->transform($task['Task']['contents']); ?></li>
    <li class="task-detail">○&ensp;期限<p><?php echo h($tmp_deadline_date); ?>&ensp;<?php echo h($tmp_deadline_time); ?></p></li>
    <li class="task-detail">○&ensp;状態<p><?php switch ($task['Task']['status']) {
                                                    case 0:
                                                        echo "下書き";
                                                        break;
                                                    case 1:
                                                        echo "作成";
                                                        break;
                                                    case 2:
                                                        echo "着手中";
                                                        break;
                                                    case 3:
                                                        echo "完了";
                                                        break;
                                                    case 4:
                                                        echo "終了";
                                                        break;
                                                    default:
                                                        echo "不正なデータです";
                                        } ?></p>
    </li>
    <li>
        <div class="task-set">
            <!-- 編集 -->
            <?php if ($auth_authority !== '0'): ?>
        	<?php echo $this->Html->link('編集', array('action' => 'edit', $group_id, $task['Task']['id'])); ?>
            <?php endif; ?>
            <!-- 削除 -->
            <?php if (!($auth_authority == '0' || $auth_authority == '1')): ?>
        	<span class="delete"><?php echo $this->Form->postLink('削除', array('action' => 'delete', $task['Task']['id']), array('confirm' => '本当に削除してもよろしいですか？')); ?></span>
            <?php endif; ?>
        </div>
    </li>
</ul>

<!-- 共有メニュー -->
<div class="task-share">
    <?php if (!($auth_authority == '0' || $auth_authority == '1')): ?>
    <p>[タスクを他のグループと共有する]</p>
    <?php echo $this->Form->create('GroupsTask'); ?>
    <div class="form-group"><?php echo $this->Form->input('group_id', array('class' => 'form-control', 'label' => 'グループ', 'options' => $groups, 'style' => 'width:200px;')); ?></div>
    <?php echo $this->Form->end(array('label' => '共有', 'class' => 'btn btn-success')); ?>
    <?php endif; ?>
</div>

</div>