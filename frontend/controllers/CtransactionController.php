<?php


namespace frontend\controllers;


use Yii;
use app\models\Session;
use frontend\models\Model;
use app\models\Ctransaction;
use frontend\models\CtransactionSearch;
use yii\rbac\Citem;
use app\models\Tables;
use app\models\DateTest;
use app\models\Ordertable;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Invoic;
use yii\web\ForbiddenHttpException;
use yii\helpers\url;


/**
 * TransactionController implements  the CRUD actions for Transaction model.
 */
class CtransactionController extends Controller
{
  /*  public $val=7;
    public $order_num=7;*/


    public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create','index','update','view','ask','report','long-report','delete', 'ask-shift', 'shift-report','error'],
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='cafeLayout';
        $searchModel = new CtransactionSearch();
        $model        = new Ctransaction();
        

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        

    }
    

    /**
     * Displays a single Transaction model.
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
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $userId     = Yii::$app->user->identity->id;
        date_default_timezone_set('Africa/Cairo');
        $this->layout="cafeTranLayout";
        $connection=\Yii::$app->db;
        $invoic_table=new Tables();
        $order_table=new Ordertable();

       /* if(isset($_SESSION["table_num"])&&$_SESSION["table_num"]!="") {*/
        if ($order_table->load(Yii::$app->request->post()))
                {
            $tables = $connection->createCommand('SELECT table_state from ctable_session where table_id=' . $order_table->order_tabe)->queryOne();
            $date_time = date('Y-m-d H:i:s');
            if ($tables["table_state"] == 0) {
                // UPDATE table_name SET column1=value1,column2=value2,...WHERE some_column=some_value;
                $update_session = $connection->createCommand('UPDATE ctable_session set table_state=1,session_start="' . $date_time . '" where table_id = ' . $order_table->order_tabe);
                $update_session->execute();
            }
        }
      /*  $user = User::model()->findByPk($userId);
        $user->username = 'hello world';
        $user->password = 'password';
        $user->update();*/
       /* $model = new Transaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/

     /*   $this->setId();
        $newId=$this->val+1;
        $this->setOrderNum();
        $newOrderNum=$this->order_num+1;*/
        $model = new Session();
       // $table=new Tables();
        $modelsTransaction = [new Ctransaction];


        if ($model->load(Yii::$app->request->post()) ) {
           //$model->date = date('Y/m/d');
           // $model->save();

            $modelsTransaction = Model::createMultiple(Ctransaction::classname());
            Model::loadMultiple($modelsTransaction, Yii::$app->request->post());


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTransaction) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsTransaction as $modelTransaction) {
                            $modelTransaction->table_table_id =$order_table->order_tabe;
                            $modelTransaction->user_id =$userId;
                            if (!($flag = $modelTransaction->save(false))) {

                                $transaction->rollBack();
                                break;
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();

                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }
            $model->deleteAll();
          /*  $model = new Invoic();
            $connection=\Yii::$app->db;
            $comand = $connection->createCommand('SELECT SUM(total) FROM ctransaction where invoice_id='.$newId)->queryScalar();
            $now =date("Y-m-d");
            $p=floatval($comand);

            $model->id=$this->getId();
            $model->cost=$p;
            $model->order_num=$this->getOrderNum();
            $model->order_date=$now;
            $model->save();
            $this->setId();
            $this->setOrderNum();*/

            return $this->redirect(['create',
                'model' => $modelsTransaction,
                'invoic_table' => $invoic_table,
                'order_table' => $order_table,
            ]);
           /*return $this->redirect(['create', 'model' => $model,
                'modelsTransaction' => (empty($modelsTransaction)) ? [new Transaction] : $modelsTransaction,
            ]);*/

        }


        else{
            return $this->render('create', [
                'model' => $model,
                'invoic_table' => $invoic_table,
                'order_table' => $order_table,
                'modelsTransaction' => (empty($modelsTransaction)) ? [new Ctransaction] : $modelsTransaction,
            ]);
        }
    }
    public function actionTable(){
         $model=[new Ctransaction];
         $connection=\Yii::$app->db;
        if(isset($_SESSION["table_num"])) {
                  //  $tab= $_POST["table_number"];
                   // $_SESSION["table_num"]=$tab;

                    echo $_SESSION["table_num"];
                  //  $connection2=\Yii::$app->db;
                    $update_session = $connection->createCommand('UPDATE rtable_session set table_state=0  where table_id = '. $_SESSION["table_num"] );
                    $update_session->execute();
                     return $this->redirect(['create',
                'model' => $model,
            ]);


               }else
                {
                     return $this->redirect(['show',
                'model' => $model,
            ]);

                }

    }

     public function actionError()
    {
        $this->layout = 'cafeLayout';
        return $this->render('error');
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
    public function actionAskShift()
    {
        if (count($this->checkPermission()) > 0 ) {

            $this->layout='cafeLayout';
            $model        = new Ctransaction();
            $dateModel    = new DateTest();
            return $this->render('ask-shift', [
                'model'     => $model,
                'dateModel' => $dateModel,
            ]);
        } else {
            return $this->redirect(['error']);
        }

    }

    public function actionShiftReport()
    {
        $this->layout='cafeLayout';
         $model        = new Ctransaction();
        if (count($this->checkPermission()) > 0 ) {

            $dateModel = new DateTest();

            if ($dateModel->load(Yii::$app->request->post())) {
                $start = $dateModel->start;
                $end   = $dateModel->end;
                return $this->render('shift-report', [
                    'start' => $start,
                    'end'   => $end,
                ]);
            } else {
                return $this->render('error', [
                    'model' => $model,
                ]);

            }
        } else {
            return $this->redirect(['error']);
        }

    }
     public function actionAsk()
    {
        $this->layout="cafeLayout";
        $model = new Ctransaction();
        $dateModel=new DateTest();
        return $this->render('ask',[
            'model'=>$model,
            'dateModel'=>$dateModel,
            ]);
        
    }
    public function actionReport(){
        $this->layout="cafeLayout";
         $model=new Ctransaction();
        if (count($this->checkPermission()) > 0 ) {
         
        $dateModel=new DateTest();
           if ($dateModel->load(Yii::$app->request->post())){
            $dayDate=$dateModel->TestDay;
            return $this->render('report',[ 
            'model' => $model,
            'dayDate'=>$dayDate,
            

        ]);
        }
        } else {
            return $this->redirect(['error']);
        }

    }
        
    

    public function actionLongReport()
    {    
        $model=new Ctransaction();
    if (count($this->checkPermission()) > 0 ) {
   
        $this->layout="cafeLayout";
        $dateModel=new DateTest();
          
         
         if ($dateModel->load(Yii::$app->request->post())){
            $start=$dateModel->start;
            $end=$dateModel->end;
            return $this->render('long-report', [
            'start'=>$start,
            'end'=>$end,
        ]);
        }

    }else{
            return $this->render('error', [
            'model' => $model,
        ]);
        
        } 
     
    }
    public function actionTest(){
        $model =new Ctransaction();
        return $this->render('test', [
            'model' => $model,
        ]);
    }
    public function actionClientdetails(){
        $model =new Ctransaction();
        return $this->render('clientdetails', [
            'model' => $model,
        ]);
    }
    public function actionInvoic(){
        $this->layout="invoicLayout";
        $model =new Ctransaction();
        return $this->render('invoic', [
            'model' => $model,
        ]);
    }
    public function actionUpdatetable(){

        if(isset($_POST["table_number"])) {
            $tab= $_POST["table_number"];
            echo $tab;
            $connection2=\Yii::$app->db;
            $update_session = $connection2->createCommand('UPDATE rtable_session set table_state=0  where table_id = '.$tab );
            $update_session->execute();
        }
        $model =new Ctransaction();
        return $this->redirect(['create', 'model' => $model,] );
    }
 /*   public  function actionPrint(){
        $transaction =new Transaction();
        $this->setId();

        $model = new Invoic();
        $connection=\Yii::$app->db;
        $newid=$this->val+1;

        $comand =  $connection->createCommand('SELECT SUM(total) FROM ctransaction where invoice_id='.$newid)->queryScalar();
        $ord_date =date("Y-m-d");
        $p=floatval($comand);
        $model->id=$this->getId();
        $model->cost=$p;
        $model->order_date=$ord_date;
        $model->save();
        $this->setId();

        return $this->redirect(['invoic',
            'model' => $transaction,
        ]);

    }
  function getId(){

        return ++$this->val;
    }
    function setId(){
        $connection=\Yii::$app->db;
        $comand2 = $connection->createCommand("SELECT id FROM invoic  ORDER by id DESC")->queryScalar();
        $this->val = floatval($comand2);
    }
    function getOrderNum(){

        return ++$this->order_num;
    }
    function setOrderNum(){
        $now =date("Y-m-d");
        $connection=\Yii::$app->db;
        $comand3 = $connection->createCommand("SELECT order_date FROM invoic ORDER by id DESC")->queryScalar();
        $comand1 = $connection->createCommand("SELECT order_num FROM invoic ORDER by id DESC")->queryScalar();
        print_r($comand3);
       $ord_num = floatval($comand1);
            $order_date = $comand3;
            if ($now == $order_date) {
                $this->order_num = $ord_num;
            } else {
                $this->order_num = 0;
            }

    }*/


    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
   
    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (count($this->checkPermission()) > 0 ) {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        } else {
            return $this->redirect(['error']);
        }

    
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ctransaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
