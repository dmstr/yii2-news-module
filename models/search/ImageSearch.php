<?php

namespace dmstr\news\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\news\models\Image;

/**
 * ImageSearch represents the model behind the search form about Image.
 */
class ImageSearch extends Model
{
	public $id;
	public $photo_gallery_id;
	public $image;
	public $title;
	public $text_html;
	public $published_at;
	public $source;
	public $tags;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'photo_gallery_id'], 'integer'],
			[['image', 'title', 'text_html', 'published_at', 'source', 'tags', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'photo_gallery_id' => 'Photo Gallery ID',
			'image' => 'Image',
			'title' => 'Title',
			'text_html' => 'Text Html',
			'published_at' => 'Published At',
			'source' => 'Source',
			'tags' => 'Tags',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Image::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'photo_gallery_id' => $this->photo_gallery_id,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text_html', $this->text_html])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'tags', $this->tags]);

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
