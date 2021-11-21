<?php

namespace app\modules\models\category;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property int $id_parent
 * @property string $slug
 * @property string $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'status'], 'required'],
            [['title', 'slug', 'status'], 'string', 'max' => 255],
            [['id_parent'], 'safe']
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
            'id_parent' => 'Parent category',
            'slug' => 'Slug',
            'status' => 'Status',
        ];
    }

    
}
