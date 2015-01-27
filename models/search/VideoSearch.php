<?php

namespace dmstr\news\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\news\models\Video;

/**
 * VideoSearch represents the model behind the search form about Video.
 */
class VideoSearch extends Model
{
	public $id;
	public $video_gallery_id;
	public $title;
	public $youtube_url;
	public $published_at;
	public $created_at;
	public $updated_at;

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
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'video_gallery_id' => 'Video Gallery ID',
			'title' => 'Title',
			'youtube_url' => 'Youtube Url',
			'published_at' => 'Published At',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Video::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
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
