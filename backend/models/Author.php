<?php

namespace backend\models;

class Author extends \yii\db\ActiveRecord {
    public static function tableName()
    {
        return parent::tableName(); // TODO: Change the autogenerated stub
    }

    public static function getAll() {
        $data = self::find()->all();
        return $data;
    }

    public static function getOne($id) {
        return self::find()->where(["id" => $id])->one();
    }
}