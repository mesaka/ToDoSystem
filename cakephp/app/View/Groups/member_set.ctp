<div class="container">
<p><?php echo $this->Html->link('戻る', array('action' =>'edit', $group_id)); ?></p>

<div class="row">
        <div class="set-menu-wrap">
                <div class="col-xs-12 col-sm-12 col-md-3">
                        <?php echo $this->Form->create('GroupsUser'); ?>
                        <?php echo $this->Form->hidden('GroupsUser.group_id', array('value' => $group_id)); ?>
                        <div class="form-group"><?php echo $this->Form->input('user_id',array('options' => $users, 'class' => 'form-control', 'label' => 'メンバー追加', 'style' => 'width:200px;')); ?></div>
                        <div class="form-group"><?php echo $this->Form->submit('追加', array('name' => 'member_add', 'class' => 'btn btn-success')); ?></div>
                        <?php echo $this->Form->end(); ?>
                </div>


                <div class="set-menu col-xs-12 col-sm-12 col-md-7">
                        <p>メンバー設定</p>
                        <table>
                        	<?php foreach ($group['User'] as $group_user): ?>
                        	<tr>
                        	       <td><?php echo $group_user['username']; ?></td>
                                <td>
                                        <?php echo $this->Form->create('GroupsUser'); ?>
                                	<?php echo $this->Form->input('authority',array(
                                                                                'options' => array(0 => '閲覧のみ', 1 => '書き込み権限なし', 2 => '書き込み権限あり', 3 => '管理者'),
                                						'label' => false,
                                						'default' => $group_user['GroupsUser']['authority'])); ?>
                                </td>
                                <td>
                                        <?php echo $this->Form->input('report',array(
                                                                                'options' => array(0 => '報告メールを受け取らない', 1 => '報告メールを受け取る'),
                                                                                'label' => false,
                                                                                'default' => $group_user['GroupsUser']['report'])); ?>
                                </td>
                                <td>
                                        <?php echo $this->Form->hidden('GroupsUser.id', array('value' => $group_user['GroupsUser']['id'])); ?>
                                	<?php echo $this->Form->submit('変更', array('name' => 'ch_member_set'.$group_user['GroupsUser']['id'])); ?>
                                	<?php echo $this->Form->end(); ?>
                                </td>
                                <td><?php echo $this->Form->postLink('x', array('controller' => 'groupsUsers', 'action' => 'delete', $group_id, $group_user['id']), array('confirm' => '本当に削除してもよろしいですか')); ?></td>

                        	</tr>
                        	<?php endforeach; ?>
                        </table>
                </div>
                <div class="set-menu col-xs-12 col-sm-12 col-md-2">
                        <ul>
                                <li>
                                        <strong>管理者</strong><br>
                                        全部のタスクに編集、状態更新、削除が可能。
                                </li>
                                <li>
                                        <strong>書き込み権限あり</strong><br>
                                        書き込み権限があるタスクに編集、状態更新、削除が可能。
                                </li>
                                <li>
                                        <strong>書き込み権限なし</strong><br>
                                        全部のタスクに状態変更が可能。
                                </li>
                                <li>
                                        <strong>閲覧のみ</strong><br>
                                        表示されるだけ。
                                </li>
                                <li>
                                        <strong>報告メール</strong><br>
                                        タスクがが新規作成、編集、状態更新、削除された時にメールを送信する。
                                </li>
                        </ul>
                </div>
        </div>
</div>

</div>