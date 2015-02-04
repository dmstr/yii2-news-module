<?php

namespace dmstr\modules\news\models\base;

use Yii;

/**
 * This is the base-model class for table "dmstr_video".
 *
 * @property integer $id
 * @property integer $video_gallery_id
 * @property string $title
 * @property string $youtube_url
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \dmstr\modules\news\models\VideoGallery $videoGallery
 */
class Video extends \dmstr\modules\news\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmstr_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_gallery_id', 'title', 'youtube_url', 'published_at'], 'required'],
            [['video_gallery_id'], 'integer'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'youtube_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_gallery_id' => Yii::t('app', 'Video Gallery ID'),
            'title' => Yii::t('app', 'Title'),
            'youtube_url' => Yii::t('app', 'Youtube Url'),
            'published_at' => Yii::t('app', 'Published At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoGallery()
    {
        return $this->hasOne(\dmstr\modules\news\models\VideoGallery::className(), ['id' => 'video_gallery_id']);
    }
}
