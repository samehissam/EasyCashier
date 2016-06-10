<?php

namespace frontend\controllers;

use app\models\Cexpenses;
use app\models\DateTest;
use frontend\models\CexpensesSearch;
use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CexpensesController implements the CRUD actions for Cexpenses model.
 */
class CexpensesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create', 'index', 'error', 'update', 'view', 'ask', 'report', 'long-report'],
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
     * Lists all Cexpenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout                       = "cafeLayout";
        $searchModel                        = new CexpensesSearch();
        $dataProvider                       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAsk()
    {
        $this->layout = "cafeLayout";
        $model        = new Cexpenses();
        $dateModel    = new DateTest();
        return $this->render('ask', [
            'model'     => $model,
            'dateModel' => $dateModel,
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
     * Displays a single Cexpenses model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cexpenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'cafeLayout';
        $model        = new Cexpenses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة بيانات المصروف بنجاح تقدر حضرت تعدل بيانات مصروفات آخري. </span>");

            return $this->redirect(['create'], [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionReport()
    {
        $this->layout = "cafeLayout";
        if (count($this->checkPermission()) > 0 ) {
            $dateModel   = new DateTest();
            $searchModel = new CexpensesSearch();
            if ($dateModel->load(Yii::$app->request->post())) {
                $day = $dateModel->TestDay;

                $dataProvider = new SqlDataProvider([
                    'sql'    => 'SELECT cexpensetype.name,cost,cexpenses.date,description from cexpenses INNER JOIN cexpensetype
    ON cexpensetype.id=cexpenses.expense_type_id WHERE Date(date )=:publish',
                    //
                    'params' => [':publish' => $day],

                    //'sort' =>false, to remove the table header sorting
                    /*'sort' => [
                'attributes' => [
                'title' => [
                'asc' => ['title' => SORT_ASC],
                'desc' => ['title' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Post Title',
                ],
                'author' => [
                'asc' => ['author' => SORT_ASC],
                'desc' => ['author' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Name',
                ],
                'created_on'
                ],
                ],
                'pagination' => [
                'pageSize' => 2,
                ],*/
                ]);

                $models = $dataProvider;
                return $this->render('report',
                    ['lista' => $models,
                        'day'    => $day,
                    ]);
            }
       } else {
            return $this->redirect(['error']);
        }


    
    }
    public function actionLongReport()
    {
        $this->layout = "cafeLayout";
        if (count($this->checkPermission()) > 0 ) {
        $dateModel    = new DateTest();
        $searchModel  = new CexpensesSearch();
        if ($dateModel->load(Yii::$app->request->post())) {
            $start = $dateModel->start;
            $end   = $dateModel->end;

            $dataProvider = new SqlDataProvider([
                'sql'    => 'SELECT cexpensetype.name,cost,cexpenses.date,description from cexpenses INNER JOIN cexpensetype
    ON cexpensetype.id=cexpenses.expense_type_id WHERE Date(date ) between :start  and  :ende',
                //
                'params' => [':start' => $start, ':ende' => $end],

                //'sort' =>false, to remove the table header sorting
                /*'sort' => [
            'attributes' => [
            'title' => [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
            'default' => SORT_DESC,
            'label' => 'Post Title',
            ],
            'author' => [
            'asc' => ['author' => SORT_ASC],
            'desc' => ['author' => SORT_DESC],
            'default' => SORT_DESC,
            'label' => 'Name',
            ],
            'created_on'
            ],
            ],*/

            ]);

            $models = $dataProvider;
            return $this->render('long-report',
                ['lista' => $models,

                    'start'  => $start,
                    'end'    => $end,
                ]);
        }
     } else {
            return $this->render('error', [
                'model' => $model,
            ]);

        }

    }

    /**
     * Updates an existing Cexpenses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = "cafeLayout";
        $model        = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم تعديل بيانا المصروف بنجاح تقدر حضرت تعدل بيانات مصروفات آخري. </span>");

            return $this->redirect(['index'], [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Cexpenses model.
     * If deletion is successful,   the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cexpenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cexpenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cexpenses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
