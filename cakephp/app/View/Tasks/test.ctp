<?php echo $this->Html->css('simple-sidebar'); ?>



    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <p>Menu</p>
                </li>
                <li>
                    <?php echo $this->Html->link('グループ一覧へ', array('controller' => 'groups', 'action' =>'test')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('カレンダー表示', array('controller' => 'tasks', 'action' =>'schedule')); ?>
                </li>
                <div class="category-menu">
                    <li class="category-menu-brand">Categories</li>
                    <?php foreach ($categories as $category): ?>
                    <li class="text-muted"><?php echo $this->Html->link($category['Category']['name'], array('controller' => 'tasks', 'action'=>'category_index',$category['Category']['id'])); ?></li>
                    <?php endforeach; ?>
                    <?php unset($category); ?>
                    <li><?php echo $this->Html->link('カテゴリー追加', array('controller' => 'categories', 'action' =>'add')); ?></li>
                </div>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <div class="task_content">
                            <ul>
                                <?php foreach ($tasks as $task): ?>
                                <li><span class="glyphicon glyphicon-tag"></span><span class="task_title"><?php echo $this->Html->link($task['Task']['title'], array('action' => 'view', $task['Task']['id'])); ?></span><span class="task_delete"><?php echo $this->Form->postLink('x', array('action' => 'delete', $task['Task']['id']), array('confirm' => '本当に削除してもよろしいですか？')); ?></span></li>
                                <?php endforeach; ?>
                                <?php unset($tasks); ?>
                                <li>+<span class="task_add"><?php echo $this->Html->link('タスクの追加', array('action' => 'add')); ?></span></li>
                            </ul>
                        </div>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

