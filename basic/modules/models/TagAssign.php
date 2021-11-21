<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "tag_assign".
 *
 * @property int $id
 * @property string $tag_id
 * @property string $article_id
 */
class TagAssign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag_assign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_id', 'article_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'article_id' => 'Article ID',
        ];
    }

    public function getTagAssign()
    {
        return $this->hasOne(Tag::className(),['id'=>'tag_id']);
    }



}
