<?php

namespace dmstr\modules\news\models\base;

use Yii;

/**
 * This is the base-model class for table "dmstr_news".
 *
 * @property integer $id
 * @property string $title
 * @property string $text_html
 * @property string $location
 * @property string $published_at
 * @property string $image
 * @property string $image_source
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \dmstr\modules\news\models\ImageGallery[] $imageGalleries
 * @property \dmstr\modules\news\models\TextBlock[] $textBlocks
 * @property \dmstr\modules\news\models\VideoGallery[] $videoGalleries
 */
class News extends \dmstr\modules\news\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmstr_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text_html', 'published_at', 'image', 'image_source'], 'required'],
            [['text_html'], 'string'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'location', 'image', 'image_source'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text_html' => Yii::t('app', 'Text Html'),
            'location' => Yii::t('app', 'Location'),
            'published_at' => Yii::t('app', 'Published At'),
            'image' => Yii::t('app', 'Image'),
            'image_source' => Yii::t('app', 'Image Source'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageGalleries()
    {
        return $this->hasMany(\dmstr\modules\news\models\ImageGallery::className(), ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextBlocks()
    {
        return $this->hasMany(\dmstr\modules\news\models\TextBlock::className(), ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoGalleries()
    {
        return $this->hasMany(\dmstr\modules\news\models\VideoGallery::className(), ['news_id' => 'id']);
    }
}
