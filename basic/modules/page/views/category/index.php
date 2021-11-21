<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\page\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
<h1><?= $cater->title?></h1>

<?php if($subCater):?>
    <h4>Subcategory</h4>
<?php foreach($subCater as $one):?>
    <?php $url = Url::to(['/page/category/'.$one->slug]);?>  
    <?php $name = yii\bootstrap\Html::encode($one->title); ?>
    <?php $options = ['title' => $name];?>
    
    <h5><?php echo yii\bootstrap\Html::a($name, $url, $options);?></h5>
    <span> </span>
    <?php endforeach; ?>
    <?php endif;?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           
            //'id',
            'title',
            //'slug',
            //'author',
            //'category_id',
            //'date_create',
            'date_update',
            //'status',
            //'content:ntext',
            'short_content:ntext',
            'rating',

        ],
    ]); ?>


</div>
