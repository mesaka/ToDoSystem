<div class="container">
<?php echo $this->Html->link('戻る', array('action' => 'index')); ?>

<h1>グループ設定</h1>

<div class="row">
	<div class="group-set-wrap">
		<div class="col-xs-12 col-sm-12 col-md-4">
			<?php echo $this->Form->create('Group'); ?>
			<!-- グループ名 -->
			<div class="form-group"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'グループ名', 'style' => 'width:250px;')); ?></div>
			<!-- 完了ボタンと削除ボタンを横並びにする -->
			<div class="form-inline">
			<div class="form-group"><?php echo $this->Form->end(array('label' => '設定完了', 'class' => 'btn btn-success')); ?></div>

			<div class="form-group"><?php echo $this->Form->postLink('削除', array('action' => 'delete', $group_id), array('class' => 'btn btn-danger', 'confirm' => '本当に削除してもよろしいですか')); ?></div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-8">
			<!-- 所属メンバー -->
			<div class="group-members">
				<p style="font-weight:700;">所属メンバー</p>
				<?php foreach ($users as $user): ?>
				<?php echo $user['User']['username']; ?><br>
				<?php endforeach; ?>
			</div>
			<p><?php if ($group['Group']['user_id'] === $userSession['id']) {
						echo $this->Html->link('メンバー設定', array('action' => 'member_set', $group_id));
					} ?>
			</p>
		</div>
	</div>
</div>

</div>
