<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Test extends ActiveRecord{
     public static function tableName() {
	return 'items';
    }
    
    
}
