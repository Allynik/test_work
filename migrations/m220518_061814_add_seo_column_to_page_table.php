<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%page}}`.
 */
class m220518_061814_add_seo_column_to_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%page}}', 'seo', $this->text()->after('disabled')->comment('SEO'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page}}', 'seo');
    }
}
