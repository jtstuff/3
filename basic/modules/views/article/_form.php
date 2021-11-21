<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\models\category\Category;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\modules\models\article\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['id'=>'w0']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'article-title']) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'id' => 'article-slug']) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true, 'id' => 'article-author']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(),'id', 'title'),
['promt'=>'Категория страницы', 'id'=> 'article-category_title']
    ) ?>
    <?php
    $statusy = ['guest', 'user','admin','link'];
    ?>


    <?= $form->field($model, 'status')->dropDownList($statusy,
['promt'=>'Статус', 'id'=>'article-status']
    ) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id'=> 'article-content']) ?>

    <?= $form->field($model, 'short_content')->textarea(['rows' => 6, 'id'=> 'article-short_content']) ?>

    <?= $form->field($model, 'rating')->textInput(['id'=> 'article-rating']) ?>

    <?= $form->field($model, 'tag_array')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(app\modules\models\tag\Tag::find()->all(), 'id', 'title'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбрать тег...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
        'maximumInputLength' => 10,
        'id'=> 'article-tags'
    ],
    
]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
