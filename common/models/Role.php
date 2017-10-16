<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AccessRole[] $accessRoles
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessRoles()
    {
        return $this->hasMany(AccessRole::className(), ['role_id' => 'id']);
    }

    /*
     * Проверка на доступ к странице
     * @param integer $page
     * @return bool
     * */
    public function Access($page_id) {
        return AccessRole::find()->where(['=','role_id',$this->id])
            ->andWhere(['=','access_id',$page_id])
            ->count();
    }

    /*
     * Проверяем обслуживает ли роль данную страницу
     * @param path - отностильный путь
     * @return boolean
     * */
    public function can($path) {
        $access = Access::find()
            ->where(['in','id',$this->getAccessRoles()->select('access_id')->column()])
            ->andWhere("'".$path."' LIKE CONCAT(alias, '%')")
            ->count();
        return $access;
    }
}
