<?php

namespace app\lib\db;

use yii\db\ColumnSchemaBuilder;

/**
 * Trait for text attributes migration.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
trait TextTypeTrait
{
    /**
     * Creates a medium text column.
     *
     * @return ColumnSchemaBuilder the column instance which can be further customized
     */
    public function mediumText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext');
    }

    /**
     * Creates a long text column.
     *
     * @return ColumnSchemaBuilder the column instance which can be further customized
     */
    public function longText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
    }

    /**
     * Creates a tiny text column.
     *
     * @return ColumnSchemaBuilder the column instance which can be further customized
     */
    public function tinyText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinytext');
    }

    /**
     * @return \yii\db\Connection the database connection to be used for schema building
     */
    abstract protected function getDb();
}
