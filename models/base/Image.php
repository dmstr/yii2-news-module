<?php

namespace dmstr\modules\news\models\base;

use Yii;

/**
 * This is the base-model class for table "dmstr_image".
 *
 * @property integer $id
 * @property integer $photo_gallery_id
 * @property string $image
 * @property string $title
 * @property string $text_html
 * @property string $published_at
 * @property string $source
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \dmstr\modules\news\models\ImageGallery $photoGallery
 */
class Image extends \dmstr\modules\news\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmstr_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_gallery_id', 'image', 'title', 'text_html', 'published_at', 'source'], 'required'],
            [['photo_gallery_id'], 'integer'],
            [['text_html'], 'string'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['image', 'source'], 'string', 'max' => 255],
            [['title', 'tags'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo_gallery_id' => Yii::t('app', 'Photo Gallery ID'),
            'image' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'text_html' => Yii::t('app', 'Text Html'),
            'published_at' => Yii::t('app', 'Published At'),
            'source' => Yii::t('app', 'Source'),
            'tags' => Yii::t('app', 'Tags'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoGallery()
    {
        return $this->hasOne(\dmstr\modules\news\models\ImageGallery::className(), ['id' => 'photo_gallery_id']);
    }
}
