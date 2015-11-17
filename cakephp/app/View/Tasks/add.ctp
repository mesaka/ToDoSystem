<?php
$status = array(0 => '下書き', 1 => '作成', 2 => '着手中', 3 => '完了待ち');
?>

<div class="container">

<p><?php echo $this->Html->link('戻る', array('controller' => 'groups', 'action' =>'index')); ?></p>

<h2>タスク追加</h2>

<?php echo $this->Form->create('Task'); ?>
<!-- タイトル -->
<div class="form-group"><?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => 'タスク名', 'style' => 'width:400px;')); ?></div>
<!-- 内容 -->
<div class="form-group"><?php echo $this->Form->input('contents', array('class' => 'form-control', 'rows' => '3', 'label' => '詳細', 'style' => 'width:400px;')); ?></div>
<!-- 締め切り日 -->
<div class="form-group"><span style="font-weight:700;">締め切り日</span><div class="form-inline"><?php echo $this->Form->input('deadline_date', array(
											'class' => 'form-control ',
											'label' => false,
											'type' => 'date',
											'dateFormat' => 'YMD',
											'monthNames' => false,
											'separator' => array('年', '月', '日'),
											// 'default' => date("Y-m-d"),
											'empty' => '----',
											'style' => 'width:100px;'));
?></div></div>
<!-- 締め切り時間 -->
<div class="form-group"><span style="font-weight:700;">締め切り時間</span><div class="form-inline">
<?php echo $this->Form->input('deadline_time', array(
											'class' => 'form-control',
											'label' => false,
											'type' => 'time',
											'timeFormat' => '24',
											'interval' => 5,
											// 'default' => date("G:i"),
											'empty' => '---'));
?></div></div>
<!-- 状態 -->
<div class="form-group"><span style="font-weight:700;">状態</span>
<?php echo $this->Form->input('status', array(
											'label' => false,
											'type' => 'select',
											'options' => $status));
?></div>
<!-- 色 -->
<div class="form-group"><span style="font-weight:700;">色</span>
<?php echo $this->Form->input('color', array(
											'label' => false,
											'type' => 'select',
											'options' => array('#0099ff' => '青', '#ff0000' => '赤', '#008000' => '緑', '#ff8c00' => 'オレンジ', '#8a2be2' => '紫')));
?></div>

<?php
echo $this->Form->input('alert_switch', array( 
								    'type' => 'checkbox', 
									// 'checked' => true,
								    'label' => 'お知らせメールを受けとる'));
?>

<div class="form-group"><span style="font-weight:700;">お知らせ時間</span>
<?php echo $this->Form->input('alert_time', array(
											'label' => false,
											'type' => 'select',
											'options' => array(0 => '1ヶ月前', 1 => '2週間前', 2 => '1週間前', 3 => '3日前', 4 => '1日前', 5 => '12時間前', 6 => '6時間前', 7 => '3時間前', 8 => '1時間前', 9 => '30分前', 10 => '締め切り時間'),
											'empty' => 'なし'));
?></div>

<?php
echo $this->Form->hidden('Task.group_id', array('value' => $group_id));
echo $this->Form->end(array('label' => '追加', 'class' => 'btn btn-success'));
?>
</div>