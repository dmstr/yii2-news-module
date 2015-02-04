<?php

namespace dmstr\modules\news\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\modules\news\models\TextBlock as TextBlockModel;

/**
* TextBlock represents the model behind the search form about `dmstr\modules\news\models\TextBlock`.
*/
class TextBlock extends TextBlockModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'news_id'], 'integer'],
            [['title', 'text_html', 'source', 'image', 'published_at', 'created_at', 'updated_at'], 'safe'],
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
$query = TextBlockModel::find();

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
            'news_id' => $this->news_id,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text_html', $this->text_html])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'image', $this->image]);

return $dataProvider;
}
}