<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role`.
 */
class m171016_090047_create_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('role');
    }
}
