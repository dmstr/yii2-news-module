<?php

namespace dmstr\modules\news\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\modules\news\models\Video as VideoModel;

/**
* Video represents the model behind the search form about `dmstr\modules\news\models\Video`.
*/
class Video extends VideoModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'video_gallery_id'], 'integer'],
            [['title', 'youtube_url', 'published_at', 'created_at', 'updated_at'], 'safe'],
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
$query = VideoModel::find();

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
            'video_gallery_id' => $this->video_gallery_id,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'youtube_url', $this->youtube_url]);

return $dataProvider;
}
}