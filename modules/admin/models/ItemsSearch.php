<?php
namespace app\modules\admin\models;

use Yii;
 use app\modules\admin\models\Items;
 use yii\data\ActiveDataProvider;
 use yii\base\Model;
 
class ItemsSearch extends Items{
     public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['word','patch_of_speech'], 'string'],
          //  [['frequency'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Items::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'word', $this->word])
              ->andFilterWhere(['like', 'patch_of_speech', $this->patch_of_speech]);
       // var_dump($query); die();
        return $dataProvider;
    }
 
}
