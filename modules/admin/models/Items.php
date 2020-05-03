<?php

namespace app\modules\admin\models;

use Yii;


class Items extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'items';
    }

    
    public function rules()
    {
        return [
            [['word', 'patch_of_speech', 'frequency'], 'required'],
            [['frequency'], 'integer'],
            [['word', 'patch_of_speech'], 'string', 'max' => 100],
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Слово',
            'patch_of_speech' => 'Часть речи',
            'frequency' => 'Частота использования',
        ];
    }
}
