<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 *
 * @property AccessRole[] $accessRoles
 */
class Access extends \yii\db\ActiveRecord
{

    public $roles;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access';
    }

    public function afterSave($insert, $changedAttributes)
    {
        AccessRole::deleteAll('access_id = '.$this->id);

        if(is_array($this->roles)) {
            foreach($this->roles as $role) {
                $ar = new AccessRole();

                $ar->role_id = $role;
                $ar->access_id = $this->id;

                $ar->save();
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['roles', 'each', 'rule' => ['integer']],
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'Алиас',
            'roles' => 'Роли',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessRoles()
    {
        return $this->hasMany(AccessRole::className(), ['access_id' => 'id']);
    }
}
