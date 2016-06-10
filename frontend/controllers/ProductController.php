<?php

namespace frontend\controllers;

use Yii;
use app\models\Product;
use frontend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ProductController implements the  CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create','index','update','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $ProductId
     * @param integer $ProductCategoryId
     * @return mixed
     */
    public function actionView($ProductId, $ProductCategoryId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ProductId, $ProductCategoryId),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout="resturantLayout";
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة بيانات منتج المخزن بنجاح تقدر حضرت تضيف منتجات آخري. </span>");

            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ProductId
     * @param integer $ProductCategoryId
     * @return mixed
     */
    public function actionUpdate($ProductId, $ProductCategoryId)
    {
        $model = $this->findModel($ProductId, $ProductCategoryId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ProductId' => $model->ProductId, 'ProductCategoryId' => $model->ProductCategoryId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ProductId
     * @param integer $ProductCategoryId
     * @return mixed
     */
    public function actionDelete($ProductId, $ProductCategoryId)
    {
        $this->findModel($ProductId, $ProductCategoryId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ProductId
     * @param integer $ProductCategoryId
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ProductId, $ProductCategoryId)
    {
        if (($model = Product::findOne(['ProductId' => $ProductId, 'ProductCategoryId' => $ProductCategoryId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
