<?php

namespace app\modules\models\article;

use Yii;
use app\modules\models\TagAssign; 
use app\modules\models\tag\Tag;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $author
 * @property int $category_id
 * @property string $date_create
 * @property string $date_update
 * @property string $status
 * @property string $content
 * @property string $short_content
 * @property int $rating
 */
class Article extends \yii\db\ActiveRecord
{

    public $tag_array;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'author', 'category_id', 'status', 'content', 'short_content', 'rating'], 'required'],
            [['category_id', 'rating'], 'integer'],
            [['date_create', 'date_update'],  'date', 'format' => 'php:Y-m-d'],
            [['date_create', 'date_update'], 'safe'],
            [['content', 'short_content'], 'string'],
            [['title', 'slug', 'author', 'status'], 'string', 'max' => 255],
            [['tag_array'], 'safe'],
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
            'author' => 'Author',
            'category_id' => 'Category ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'status' => 'Status',
            'content' => 'Content',
            'short_content' => 'Short Content',
            'rating' => 'Rating',
            'tag_array'=> 'Tags',
        ];
    }


    public function getArticleTag()
{
    return $this->hasMany(TagAssign::className(),['article_id'=>'id']);
}

public function getTags()
{
    return $this->hasMany(Tag::className(),['id'=>'tag_id'])->via('articleTag');
}

public function getTagsAsString()
{
    $tagSave=ArrayHelper::map($this->tags, 'id', 'title');
    

    return implode(', ', $tagSave);
}

public function afterFind()
{
    $this->tag_array = $this->tags;
}

public function afterSave($insert, $changedAttributes)
    {

        parent::afterSave($insert, $changedAttributes);

    $tagSave=ArrayHelper::map($this->tags, 'id', 'id');

foreach($this->tag_array as $oneTag)
{
    if(!in_array($oneTag, $tagSave)){
    $model = new TagAssign();
    $model->article_id = $this->id;
    $model->tag_id = $oneTag;
    $model->save();
    if(isset($tagSave[$oneTag])){
        unset($tagSave[$oneTag]);
    }

    }
    //TagAssign::deleteAll(['tag_id'=>$tagSave]);
}
        
    }
 
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'short_content', $this->short_content]);

        return $dataProvider;
    }

    

}
