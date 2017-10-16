<?php

use yii\db\Migration;

/**
 * Handles the creation of table `access_role`.
 * Has foreign keys to the tables:
 *
 * - `role`
 * - `access`
 */
class m171016_090413_create_access_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('access_role', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(),
            'access_id' => $this->integer(),
        ]);

        // creates index for column `role_id`
        $this->createIndex(
            'idx-access_role-role_id',
            'access_role',
            'role_id'
        );

        // add foreign key for table `role`
        $this->addForeignKey(
            'fk-access_role-role_id',
            'access_role',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );

        // creates index for column `access_id`
        $this->createIndex(
            'idx-access_role-access_id',
            'access_role',
            'access_id'
        );

        // add foreign key for table `access`
        $this->addForeignKey(
            'fk-access_role-access_id',
            'access_role',
            'access_id',
            'access',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `role`
        $this->dropForeignKey(
            'fk-access_role-role_id',
            'access_role'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            'idx-access_role-role_id',
            'access_role'
        );

        // drops foreign key for table `access`
        $this->dropForeignKey(
            'fk-access_role-access_id',
            'access_role'
        );

        // drops index for column `access_id`
        $this->dropIndex(
            'idx-access_role-access_id',
            'access_role'
        );

        $this->dropTable('access_role');
    }
}
