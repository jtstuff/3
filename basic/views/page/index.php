use 

<?php

/* @var $this yii\web\View */

$this->title = 'S-page';
foreach($page as $one) 
Html::dropDownList('sort', Yii::$app->request->post('sort'), ['updated_at' => 'По умолчанию', '-created_at' => 'По дате ▲', 'created_at' => 'По дате ▼', 'price' => 'Дешевле', '-price' => 'Дороже'], ['class' => 'input-sm form-control', 'onchange' => '$("#seachobjects").submit();',])

?>
<?php foreach($page as $one):?>
        <h1><?= $one->title?></h1>

        <p class="lead"><?= $one->content?></p>

        <p><?= $one->author?></p>
    

   

<?php endforeach; ?>
