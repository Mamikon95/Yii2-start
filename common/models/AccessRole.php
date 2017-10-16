<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "access_role".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $access_id
 *
 * @property Access $access
 * @property Role $role
 */
class AccessRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'access_id'], 'integer'],
            [['access_id'], 'exist', 'skipOnError' => true, 'targetClass' => Access::className(), 'targetAttribute' => ['access_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Роль',
            'access_id' => 'Доступ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccess()
    {
        return $this->hasOne(Access::className(), ['id' => 'access_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
