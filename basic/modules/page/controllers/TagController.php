<?php

namespace app\modules\page\controllers;

use Yii;
use app\modules\models\article\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CategoryController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    public function actionIndex($slug)
    {
        $tager = \app\modules\models\tag\Tag::find()->andwhere(['slug'=>$slug])->one();
        if($tager){
            
            $art_id = ArrayHelper::map($tager->articles, 'id', 'id');
            
            $searchModel = \app\modules\models\article\Article::find()->andwhere(['id'=>$art_id]);
           
            $dataProvider = new ActiveDataProvider([
                'query' => $searchModel,
                'pagination'=>['pageSize'=>10,
                'pageSizeParam' => false],
            ]);
    
            return $this->render('index', [
                'tager' => $tager,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
