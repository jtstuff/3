<?php

namespace app\modules\page\controllers;

use Yii;
use app\modules\models\article\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex($slug)
    {
        $cater = \app\modules\models\category\Category::find()->andwhere(['slug'=>$slug])->one();
        if($cater){
            $subCater = \app\modules\models\category\Category::find()->andWhere(['id_parent'=>$cater->id])->all();
            
            $searchModel = \app\modules\models\article\Article::find()->andwhere(['category_id'=>$cater->id]);
            
            $dataProvider = new ActiveDataProvider([
                'query' => $searchModel,
                'pagination'=>['pageSize'=>10,
                'pageSizeParam' => false],
            ]);
                
            return $this->render('index', [
                'cater' => $cater,
                'subCater' => $subCater,
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
