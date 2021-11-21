<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\models\category\Category;
use app\modules\models\category\CategorySearch;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\models\category\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['id'=>'w0']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id'=>'category-title']) ?>

    <?= $form->field($model, 'id_parent')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(app\modules\models\category\Category::find()->all(), 'id', 'title'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбрать категорию...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
        'maximumInputLength' => 10,
        'id'=> 'id_parent'
    ],
]);?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'id'=>'category-slug']) ?>

    <?php
    $statusy = ['guest', 'user','admin','link'];
    ?>

    <?= $form->field($model, 'status')->dropDownList($statusy,
['promt'=>'Статус']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
