<?php

use yii\db\Migration;
use common\models\Role;

class m171016_091916_add_roles extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        //Начальные роли
        $model = new Role();
        $model->name = 'Модератор';
        $model->save();

        $model = new Role();
        $model->name = 'Администратор';
        $model->save();
    }

    public function down()
    {
        Role::deleteAll();

        //Обнуляем Auto increment
        yii::$app->db->createCommand('ALTER TABLE role AUTO_INCREMENT=0')->execute();

    }
}
