<?php
echo $this->Html->css('style');
echo $this->Html->css('https://fonts.googleapis.com/css?family=Archivo+Black');
?>

<div class="container">
    <div class="row">

        <div class="nav_content">
            <ul class="nav nav-tabs">
                <li><a href="#test" data-toggle="tab" style="display:none;">Default</a></li>
                <?php foreach ($groups as $group): ?>
                <li><a href="#<?php echo $group['Group']['id']; ?>" data-toggle="tab"><?php echo $group['Group']['name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>


        <div class="tab-content">
            <!-- アクセスしたときに初めに表示される内容 -->
            <div class="tab-pane fade in active" id="test">
                <h1><?php if (isset($userSession)) {
                                echo 'ようこそ' . $userSession['username'] . 'さん';
                            } else {
                                echo 'ようこそゲストさん';
                            } ?>
                </h1>
                <ul style="float:right;">
                    <li><?php echo $this->Html->link('グループ追加', array('action' => 'add')); ?></li>
                </ul>
            </div>

            <?php foreach ($groups as $group): ?>
            <div class="tab-pane fade" id="<?php echo $group['Group']['id']; ?>">
                <div class="task-wrap">
                    <!-- グループメニュー -->
                    <div class="group-menu col-xs-12 col-sm-12 col-md-12">
                        <ul style="float:right;">
                            <li><?php echo $this->Html->link('グループ追加', array('action' => 'add')); ?></li>
                            <li><?php echo $this->Html->link('グループ設定', array('action' => 'edit', $group['Group']['id'])); ?></li>
                        </ul>
                    </div>

                    <!-- タスク一覧 -->
                    <div class="task-menu">
                        <ul>
                            <?php foreach ($group['Task'] as $task): ?>
                            <div class="task-lists">
                                <!-- 下書き -->
                                <?php if ($task['status'] === '0'): ?>
                                    <!-- タスクの作成者本人だったら -->
                                    <?php if ($task['user_id'] === $userSession['id']): ?>
                                        <?php if ($task['deleted_date'] === null): ?>
                                            <div class="col-xs-12 col-sm-4 col-md-3">
                                                <li>
                                                <!-- タイトル -->
                                                <span class="task-title"><a style="background:<?php echo $task['color']; ?>" href="/kadai/cakephp/tasks/view/<?php echo $group['Group']['id'].'/'.$task['id']?>"><?php echo $task['title']; ?></a></span>
                                                <!-- 削除 -->
                                                <span class="task-delete"><?php echo $this->Form->postLink('X', array('controller' => 'tasks', 'action' => 'delete', $task['id'], $group['Group']['id']), array('confirm' => '本当に削除してもよろしいですか')); ?></span>
                                                </li>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        
                                    <?php endif; ?>
                                <!-- 下書き以外 -->
                                <?php else: ?>
                                    <?php if ($task['deleted_date'] === null): ?>
                                        <div class="col-xs-12 col-sm-4 col-md-3">
                                            <li>
                                            <!-- タイトル -->
                                            <span class="task-title"><a style="background:<?php echo $task['color']; ?>" href="/kadai/cakephp/tasks/view/<?php echo $group['Group']['id'].'/'.$task['id']?>"><?php echo $task['title']; ?></a></span>
                                            <!-- 削除 -->
                                            <span class="task-delete"><?php echo $this->Form->postLink('X', array('controller' => 'tasks', 'action' => 'delete', $task['id'], $group['Group']['id']), array('confirm' => '本当に削除してもよろしいですか')); ?></span>
                                            </li>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                            <li class="add_task col-xs-12 col-sm-4 col-md-3"><?php echo $this->Html->link('タスク追加', array('controller' => 'tasks', 'action'=>'add', $group['Group']['id'])); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>


<script>


$(function() {
    
});

</script>