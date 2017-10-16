<?php

use yii\db\Migration;

/**
 * Handles the creation of table `access`.
 */
class m171016_090325_create_access_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('access', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('access');
    }
}
