<?php

namespace dmstr\modules\news\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\modules\news\models\News as NewsModel;

/**
* News represents the model behind the search form about `dmstr\modules\news\models\News`.
*/
class News extends NewsModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id'], 'integer'],
            [['title', 'text_html', 'location', 'published_at', 'image', 'image_source', 'created_at', 'updated_at'], 'safe'],
];
}

/**
* @inheritdoc
*/
public function scenarios()
{
// bypass scenarios() implementation in the parent class
return Model::scenarios();
}

/**
* Creates data provider instance with search query applied
*
* @param array $params
*
* @return ActiveDataProvider
*/
public function search($params)
{
$query = NewsModel::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text_html', $this->text_html])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_source', $this->image_source]);

return $dataProvider;
}
}