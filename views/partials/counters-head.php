<?php
use app\modules\admin\models\TextBlock;

?>
<?php if (!YII_DEBUG): ?>
<!-- counters-head -->
<?php if ($counterBlock = TextBlock::getTextBlock('Счетчики: head', 'textarea')): ?>
<?= $counterBlock; ?>
<?php endif; ?>
<!-- /counters-head -->
<?php endif; ?>