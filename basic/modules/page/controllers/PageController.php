<?php

namespace app\modules\page\controllers;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use app\modules\models\article\ArticleSearch;


class PageController extends \yii\web\Controller
{





    
    public function actionIndex()
{
    $searchModel = new ArticleSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
   /* $page = \app\modules\page\models\Article::find()->andwhere(['status'=>0])->all();

    return $this->render('index', [
        'page' => $page,
    ]);*/
}

public function actionRating(){
    if($_POST){  
        $user_ip = Yii::$app->request->userIP;
        $rate = \app\modules\models\Rating::find()->andwhere(['user_ip'=>$user_ip])->one();
        if(!$rate){
            $newRate = new \app\modules\models\Rating();
            $newRate->user_ip = $user_ip;
            $newRate->article_id = $_POST['id'];
            $newRate->stars = $_POST['stars']; 
            $newRate->save();

            $rateall = \app\modules\models\Rating::find()->andwhere(['article_id'=>$_POST['id']])->select('stars');
            $allStars = $rateall->count();
            $sumStars = $rateall->sum('stars');
            $totalRating = round($sumStars / $allStars, 0);
            
            $inst = \app\modules\models\article\Article::findOne($_POST['id']);
            $inst->rating = $totalRating;
            $inst->save();
        }
            
    }
                return $this->render('spage', [
                    'page' => $page,
                ]);
}

public function actionSpage($slug)
{
    $searchRating = new \app\modules\models\Rating();
    $page = \app\modules\models\article\Article::find()->andwhere(['slug'=>$slug])->one();

    if($page){

    if($page->status==0 || $page->status==3){

        $page_tag = $page->tag_array;
    return $this->render('spage', [
        'page' => $page,
        'page_tag'=>$page_tag,
        'searchRating'=>$searchRating,
    ]);
    
    }else if($page->status==1){
        if(!Yii::$app->user->isGuest){
            $page_tag = $page->tag_array;
            return $this->render('spage', [
                'page' => $page,
                'page_tag'=>$page_tag,
                'searchRating'=>$searchRating,
            ]); 
        }else{
            throw new NotFoundHttpException('Check access right');
        }

        
    }else if($page->status==2){

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->username=='admin'){
            $page_tag = $page->tag_array;
        
            return $this->render('spage', [
                'page' => $page,
                'page_tag'=>$page_tag,
                'searchRating'=>$searchRating,
            ]); 
        }else{
        throw new NotFoundHttpException('Check access right');
        }
    }

    }else{
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

}
