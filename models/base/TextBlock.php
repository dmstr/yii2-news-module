<?php

namespace dmstr\modules\news\models\base;

use Yii;

/**
 * This is the base-model class for table "dmstr_text_block".
 *
 * @property integer $id
 * @property integer $news_id
 * @property string $title
 * @property string $text_html
 * @property string $source
 * @property string $image
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \dmstr\modules\news\models\News $news
 */
class TextBlock extends \dmstr\modules\news\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmstr_text_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id'], 'integer'],
            [['text_html', 'published_at'], 'required'],
            [['text_html'], 'string'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['source', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'news_id' => Yii::t('app', 'News ID'),
            'title' => Yii::t('app', 'Title'),
            'text_html' => Yii::t('app', 'Text Html'),
            'source' => Yii::t('app', 'Source'),
            'image' => Yii::t('app', 'Image'),
            'published_at' => Yii::t('app', 'Published At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(\dmstr\modules\news\models\News::className(), ['id' => 'news_id']);
    }
}
