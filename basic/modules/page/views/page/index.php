<?php

/* @var $this yii\web\View */
/*
$this->title = 'S-page';
foreach($page as $one)
?>
<?php foreach($page as $one):?>
        <h3><?= $one->title?></h3>
        <p class="lead"><?= $one->short_content?></p>
        <?= \yii\bootstrap\Html::a('далее',['page/spage', 'slug'=>$one->slug], ['class'=>'btn btn-success'] )?>
        <p><?= $one->date_update?></p>
    

   

<?php endforeach; ?>

*/

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\models\article\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

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