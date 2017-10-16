<?php

use yii\db\Migration;
use frontend\models\SignupForm;
use common\models\User;

class m171016_084040_add_admin extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // Создаем админа
        $model = new SignupForm();
        $model->username = 'admin';
        $model->password = 'webmaster';
        $model->email = 'webmaster@webmaster.dev';
        $model->role = 2;

        $model->signup();
    }

    public function down()
    {
        $model = User::find()->where(['=','username','admin'])->one();

        if($model) {
            $model->delete();
        }
    }
}
