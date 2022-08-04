<?php
use app\modules\admin\models\TextBlock;

?>
<?php if (!YII_DEBUG): ?>
<div class="counters-body">
    <!-- counters-body-close -->
    <?php if ($counterBlock = TextBlock::getTextBlock('Счетчики: конец body', 'textarea')): ?>
    <?= $counterBlock; ?>
    <?php endif; ?>
    <!-- /counters-body-close -->
</div>
<?php endif; ?>