<?php

namespace dmstr\news\models\base;

use Yii;

/**
 * This is the base-model class for table "dmstr_video_gallery".
 *
 * @property integer $id
 * @property integer $news_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \dmstr\news\models\Video[] $videos
 * @property \dmstr\news\models\News $news
 */
class VideoGallery extends \dmstr\news\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmstr_video_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id'], 'integer'],
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100]
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
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(\dmstr\news\models\Video::className(), ['video_gallery_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(\dmstr\news\models\News::className(), ['id' => 'news_id']);
    }
}
