<?php

namespace frontend\controllers;

use Yii;
use app\models\Rexpenses;
use frontend\models\RexpensesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DateTest;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
/**
 * RexpensesController implements the  CRUD actions for Rexpenses model.
 */
class RexpensesController extends Controller
{
    public function behaviors()
    {
       return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create','index','update','error','view','ask','report','long-report'],
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
     * Lists all Rexpenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout="resturantLayout";
        $searchModel = new RexpensesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination->pageSize=20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


        public function actionReport(){
        $this->layout="resturantLayout";
         if (count($this->checkPermission()) > 0 ) {
        $dateModel=new DateTest();
       $searchModel = new RexpensesSearch();
        if ($dateModel->load(Yii::$app->request->post())){
                $day=$dateModel->TestDay;

        

    $dataProvider = new SqlDataProvider([
        'sql' => 'SELECT rexpensetype.name,cost,rexpenses.date,description from rexpenses INNER JOIN rexpensetype
    ON rexpensetype.id=rexpenses.expense_type_id WHERE Date(date )=:publish',
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
        ['lista'=>$models,
        'day'=>$day,
        ]);
    }
    } else {
            return $this->redirect(['error']);
        }
    }

 public function actionLongReport(){
     $this->layout="resturantLayout";
     if (count($this->checkPermission()) > 0 ) {
        $dateModel=new DateTest();
       $searchModel = new RexpensesSearch();
        if ($dateModel->load(Yii::$app->request->post())){
                $start=$dateModel->start;
                $end=$dateModel->end;

        

    $dataProvider = new SqlDataProvider([
        'sql' => 'SELECT rexpensetype.name,cost,rexpenses.date,description from rexpenses INNER JOIN rexpensetype
    ON rexpensetype.id=rexpenses.expense_type_id WHERE Date(date ) between :start  and  :ende',
        //
        'params' => [':start' => $start,':ende'=>$end],
        
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
        ['lista'=>$models,
        
        'start'=>$start,
        'end'=>$end,
        ]);
    }
    } else {
            return $this->redirect(['error']);
        }
    }
    
    public function actionAsk(){
        $this->layout= 'resturantLayout';
        $dateModel=new DateTest();
        return $this->render('ask', [
                //'expenseModel' => $expenseModel,
                'dateModel'=>$dateModel
            ]); 
    }

    /**
     * Displays a single Rexpenses model.
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
        $this->layout = 'resturantLayout';
        return $this->render('error');
    }

    /**
     * Creates a new Rexpenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $this->layout= 'resturantLayout';
        $model = new Rexpenses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة بيانات المصروف بنجاح تقدر حضرت تعدل بيانات مصروفات آخري. </span>");

            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rexpenses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم تعديل بيانا المصروف بنجاح تقدر حضرت تعدل بيانات مصروفات آخري. </span>");

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rexpenses model.
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
     * Finds the Rexpenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rexpenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rexpenses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
