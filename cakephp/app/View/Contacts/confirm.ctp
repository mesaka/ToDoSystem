<div class="container">
<h1>確認画面</h1>

<?php echo $this->Form->create('Contact', array('action' => 'send')); ?>
<!-- 名前 -->
<p>名前: <?php echo h($name); ?></p>
<?php echo $this->Form->hidden('name'); ?>
<!-- 差出人 -->
<p>差出人: <?php echo h($from); ?></p>
<?php echo $this->Form->hidden('from'); ?>
<!-- 宛先 -->
<!-- <p>宛先: <?php //echo h($to); ?></p>
<?php //echo $this->Form->hidden('to'); ?> -->
<!-- 件名 -->
<p>件名: <?php echo h($subject); ?></p>
<?php echo $this->Form->hidden('subject'); ?>
<!-- 本文 -->
<p>本文: <?php echo h($message); ?></p>
<?php echo $this->Form->hidden('message'); ?>
<?php echo $this->Form->end('送信'); ?>
</div>