<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div id="<?php echo isset($key) ? h($key):null; ?>Message" class="<?php echo h($class) ?>"><?php echo h($message) ?></div>