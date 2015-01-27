<?php

namespace dmstr\news\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\news\models\VideoGallery;

/**
 * VideoGallerySearch represents the model behind the search form about VideoGallery.
 */
class VideoGallerySearch extends Model
{
	public $id;
	public $news_id;
	public $name;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'news_id'], 'integer'],
			[['name', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'news_id' => 'News ID',
			'name' => 'Name',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = VideoGallery::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'news_id' => $this->news_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
