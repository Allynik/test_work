<?php
use app\modules\admin\models\TextBlock;

?>
<?php if (!YII_DEBUG): ?>
<div class="counters-body">
    <!-- counters-body-open -->
    <?php if ($counterBlock = TextBlock::getTextBlock('Счетчики: начало body', 'textarea')): ?>
    <?= $counterBlock; ?>
    <?php endif; ?>
    <!-- /counters-body-open -->
</div>
<?php endif; ?>