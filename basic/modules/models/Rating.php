<?php
namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "fl_rating".
 *
 * @property integer $article_id

 * @property integer $user_ip
 * @property integer $page_id
 * @property double $stars
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id'], 'integer'],
            [['stars', 'user_ip'], 'required'],
        ];
    }
    
    public function getArticle(){
        return $this->hasOne(Article::className(),['id'=>'article_id']);
    }
    /**
     * @inheritdoc
     */
    
}