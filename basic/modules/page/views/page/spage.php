<?php
use yii\helpers\Url;
use yii\web\JsExpression;


/* @var $this yii\web\View */

$this->title = 'S-page';
?>
 <h1><?= $page->title?></h1>

        <p class="lead"><?= $page->content?></p>

        <p><?= $page->author?></p>

        <?php foreach($page->tags as $one):?>

       <?php 
       $id = $page->id;
       $url_tag = '/page/tag/'.$one->slug;
       $url = Url::to([$url_tag, 'slug'=>$one->slug]);
       $name = yii\bootstrap\Html::encode($one->title);
       $options = [
       'title' => $name    
       ];?>
       <?= yii\bootstrap\Html::a($name, $url, $options);?>
       <span>,</span>
       <?php endforeach; ?>



       
       <?= \kartik\rating\StarRating::widget(['name' => 'rating_1', 
       'value' => $page->rating,
    'pluginOptions' => [
        'filledStar' => '★',
        'emptyStar' => '☆',
        'showClear'=>false,
        'min' => 0,
        'max' => 5,
        'step' => 1,
        'size'=> 'xf',
        //'filledStar' => '<i class="glyphicon glyphicon-heart"></i>',
        //'emptyStar' => '<i class="glyphicon glyphicon-heart-empty"></i>',
       // 'defaultCaption' => '{rating} hearts',
        'starCaptions' => false
    ], 
    'pluginEvents' => [
           'rating:change'=> "function(event, value,caption){
           $.ajax({
               url:'/page/page/rating',
               type:'POST',
               data:{
                   stars:value,
                   id:".$page->id."
               },
               dataType:'json',
               success:function(data){
                   location.reload();
               }
           });
        }"
    ]
]); ?>





