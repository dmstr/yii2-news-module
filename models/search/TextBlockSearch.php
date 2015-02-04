<?php

namespace dmstr\news\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\news\models\TextBlock;

/**
 * TextBlockSearch represents the model behind the search form about TextBlock.
 */
class TextBlockSearch extends Model
{
	public $id;
	public $news_id;
	public $title;
	public $text_html;
	public $source;
	public $image;
	public $published_at;
	public $created_at;
	public $updated_at;

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
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'news_id' => 'News ID',
			'title' => 'Title',
			'text_html' => 'Text Html',
			'source' => 'Source',
			'image' => 'Image',
			'published_at' => 'Published At',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = TextBlock::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
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
