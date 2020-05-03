<?php

namespace app\modules\admin\models;

use Yii;


class Usercom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
      $session = Yii::$app->session;
        return $session->get('tablename');
      //  return 'alex__com_ua';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['WORD', 'ANSWER'], 'required'],
            [['ANSWER'], 'integer'],
            [['TIME'], 'number'],
            [['DATE'], 'safe'],
            [['WORD'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'WORD' => 'Word',
            'ANSWER' => 'Answer',
            'TIME' => 'Time',
            'DATE' => 'Date',
        ];
    }
}
