<?php

namespace app\modules\models\tag;

use Yii;
use app\modules\models\article\Article;
use app\modules\models\TagAssign;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }


    public function getArticleTag()
    {
        return $this->hasMany(TagAssign::className(),['tag_id'=>'id']);
    }


    public function getArticles()
{
    return $this->hasMany(Article::className(),['id'=>'article_id'])->via('articleTag');
}
}
