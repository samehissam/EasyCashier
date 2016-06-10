<?php

namespace frontend\controllers;

use app\models\Citem;
use frontend\models\CitemSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CitemController implements the   CRUD actions for Citem model.
 */
class CitemController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create', 'error', 'index', 'update', 'view'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Citem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout                       = "cafeLayout";
        $searchModel                        = new CitemSearch();
        $dataProvider                       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Citem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function GetVolumeLabel($drive)
    {
        if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir ' . $drive . ':'), $m)) {
            $volname = ' (' . $m[1] . ')';
        } else {
            $volname = '';
        }
        return $volname;
    }
    public function checkD()
    {
        $serial     = trim(str_replace("(", "", str_replace(")", "", $this->GetVolumeLabel("c"))));
        $connection = \Yii::$app->db;
        $check      = $connection->createCommand("SELECT id from checkout WHERE name
            = " . "'" . $serial . "'")->queryAll();
        return $check;
    }

    public function checkPermission()
    {
        $userId     = Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        $checkAdmin = $connection->createCommand("SELECT item_name from auth_assignment WHERE user_id
            =" . $userId)->queryAll();
        return $checkAdmin;

    }

    public function actionError()
    {
        $this->layout = 'cafeLayout';
        return $this->render('error');
    }

    /**
     * Creates a new Citem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "cafeLayout";
        $model        = new Citem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة بيانات المنتج بنجاح تقدر حضرت تضيف بيانات لمنتجات آخري. </span>");

            return $this->redirect(['create'], [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Citem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (count($this->checkPermission()) > 0 ) {

        $this->layout = "cafeLayout";
        $model        = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم تعديل بيانات الصنف بنجاح تقدر حضرت تعدل بيانات أصناف آخري. </span>");

            return $this->redirect(['index'], [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        } else {
            return $this->render('error', [
                'model' => $model,
            ]);

        }

    }
    /**
     * Deletes an existing Citem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Citem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Citem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Citem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
