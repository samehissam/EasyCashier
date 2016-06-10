<?php

namespace frontend\controllers;

use app\models\DateTest;
use app\models\Invoic;
use app\models\Rcustomer;
use app\models\Rtransaction;
use app\models\Session;
use frontend\models\Model;
use frontend\models\RtransactionSearch;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TransactionController implements the CRUD  actions for Transaction model.
 */
class RtransactionController extends Controller
{
    public $val       = 7;
    public $order_num = 7;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['order','create', 'error', 'show', 'update', 'delete', 'ask-shift', 'shift-report', 'invoic', 'index', 'report', 'mpdf-demo-1', 'clientdetails', 'ask', 'test','cust','add', 'print', 'long-report', 'partinvoic'],
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout                       = "resturantLayout";
        $searchModel                        = new RtransactionSearch();
        $dataProvider                       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel'  => $searchModel,
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
    public function actionError()
    {
        $this->layout = 'resturantLayout';
        return $this->render('error');
    }
     public function actionOrder()
    {
       $this->layout = "aboutLayout";
        return $this->render('order');
    }


    /*  public function actionUpdate($id)
    {
    $model = $this->findModel($id);
    $modelOrderItems = $model->wholesalerOrderItems;

    $oldIDs = ArrayHelper::map($modelOrderItems, 'id', 'id');
    print_r($oldIDs);
    $modelOrderItems = Model::createMultiple(WholesalerOrderItem::classname(), $modelOrderItems);
    Model::loadMultiple($modelOrderItems, Yii::$app->request->post());
    $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelOrderItems, 'id', 'id')));

    // ajax validation
    if (Yii::$app->request->isAjax) {
    Yii::$app->response->format = Response::FORMAT_JSON;
    return ArrayHelper::merge(
    ActiveForm::validateMultiple($modelOrderItems),
    ActiveForm::validate($model)
    );
    }

    // validate all models
    $valid = $model->validate();
    $valid = Model::validateMultiple($modelOrderItems) && $valid;

    if ($valid) {
    $transaction = \Yii::$app->db->beginTransaction();
    try {
    if ($flag = $model->save(false)) {
    if (! empty($deletedIDs)) {
    WholesalerOrderItem::deleteAll(['id' => $deletedIDs]);
    }
    foreach ($modelOrderItems as $modelOrderItem) {
    $modelOrderItem->order_id = $model->id;
    if (! ($flag = $modelOrderItem->save(false))) {
    $transaction->rollBack();
    break;
    }
    }
    }
    if ($flag) {
    $transaction->commit();
    //return $this->redirect(['view', 'id' => $model->id]);
    }
    } catch (Exception $e) {
    $transaction->rollBack();
    }
    }
    return $this->render('update', [
    'model' => $model,
    '$modelOrderItems' => (empty($modelOrderItems)) ? [new WholesalerOrderItem] : $modelOrderItems
    ]);
    }*/

    /*public function actionUpdate($id)
    {

    $model = $this->findModel($id);
    $modelsTransaction = $model->;
    //  $modelCustomer = $this->findModel($id);
    //  $modelsAddress = $modelCustomer->addresses;

    if ($modelCustomer->load(Yii::$app->request->post())) {

    $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
    $modelsAddress = Model::createMultiple(Address::classname(), $modelsAddress);
    Model::loadMultiple($modelsAddress, Yii::$app->request->post());
    $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

    // ajax validation
    if (Yii::$app->request->isAjax) {
    Yii::$app->response->format = Response::FORMAT_JSON;
    return ArrayHelper::merge(
    ActiveForm::validateMultiple($modelsAddress),
    ActiveForm::validate($modelCustomer)
    );
    }

    // validate all models
    $valid = $modelCustomer->validate();
    $valid = Model::validateMultiple($modelsAddress) && $valid;

    if ($valid) {
    $transaction = \Yii::$app->db->beginTransaction();
    try {
    if ($flag = $modelCustomer->save(false)) {
    if (! empty($deletedIDs)) {
    Address::deleteAll(['id' => $deletedIDs]);
    }
    foreach ($modelsAddress as $modelAddress) {
    $modelAddress->customer_id = $modelCustomer->id;
    if (! ($flag = $modelAddress->save(false))) {
    $transaction->rollBack();
    break;
    }
    }
    }
    if ($flag) {
    $transaction->commit();
    return $this->redirect(['view', 'id' => $modelCustomer->id]);
    }
    } catch (Exception $e) {
    $transaction->rollBack();
    }
    }
    }

    return $this->render('update', [
    'modelCustomer' => $modelCustomer,
    'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
    ]);
    }*/
    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $userId     = Yii::$app->user->identity->id;
        $this->layout = "restTranLayout";
        //this->layout='transactionLayout';
        /* $model = new Transaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
        } else {
        return $this->render('create', [
        'model' => $model,
        ]);
        }*/

        $this->setId();
        $newId = $this->val + 1;
        $this->setOrderNum();
        $newOrderNum       = $this->order_num + 1;
        $model             = new Session();
        $modelsTransaction = [new Rtransaction];
        $modelCustomer     = new Rcustomer();

        if ($model->load(Yii::$app->request->post())) {
            //$model->date = date('Y/m/d');
            // $model->save();

            $modelsTransaction = Model::createMultiple(Rtransaction::classname());
            Model::loadMultiple($modelsTransaction, Yii::$app->request->post());

            $_SESSION["invoice_id"] = $newId;
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTransaction) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsTransaction as $modelTransaction) {
                            $modelTransaction->invoice_id = $newId;
                             $modelTransaction->user_id = $userId;
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
            $model      = new Invoic();
 
            $now        = date("Y-m-d");
         //   $p          = floatval($comand);

            $model->id         = $this->getId();
           // $model->cost       = $sum;
            $model->order_num  = $this->getOrderNum();
            $model->order_date = $now;
            $model->save();
            $this->setId();
            $this->setOrderNum();

            return $this->redirect(['create',
                'model'         => $modelsTransaction,
                'modelCustomer' => $modelCustomer,
            ]);
            /*return $this->redirect(['create', 'model' => $model,
        'modelsTransaction' => (empty($modelsTransaction)) ? [new Transaction] : $modelsTransaction,
        ]);*/

        } else {
            return $this->render('create', [
                'model'             => $model,
                'modelCustomer'     => $modelCustomer,
                'modelsTransaction' => (empty($modelsTransaction)) ? [new Rtransaction] : $modelsTransaction,
            ]);
        }

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

    public function actionAsk()
    {

        if (count($this->checkPermission()) > 0 ) {
            $this->layout = "resturantLayout";
            $model        = new Rtransaction();
            $dateModel    = new DateTest();
            return $this->render('ask', [
                'model'     => $model,
                'dateModel' => $dateModel,
            ]);
        } else {
            return $this->redirect(['error']);
        }

    }
    public function actionReport()
    {

        if (count($this->checkPermission()) > 0 ) {
            $model     = new Rtransaction();
            $dateModel = new DateTest();
            if ($dateModel->load(Yii::$app->request->post())) {
                $dayDate = $dateModel->TestDay;
                return $this->render('report', [
                    'model'   => $model,
                    'dayDate' => $dayDate,

                ]);
            }
        } else {
            return $this->redirect(['error']);
        }

    }

    public function actionLongReport()
    {

        if (count($this->checkPermission()) > 0 ) {
            $dateModel = new DateTest();

            if ($dateModel->load(Yii::$app->request->post())) {
                $start = $dateModel->start;
                $end   = $dateModel->end;
                return $this->render('long-report', [
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

    public function actionShiftReport()
    {
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
    public function actionTest()
    {
        $model = new Rtransaction();
        return $this->render('test', [
            'model' => $model,
        ]);
    }
     public function actionCust()
    {
        $model = new Rtransaction();
        return $this->render('cust', [
            'model' => $model,
        ]);
    }
     public function actionAdd()
    {
        $model = new Rtransaction();
        return $this->render('add', [
            'model' => $model,
        ]);
    }
    public function actionClientdetails()
    {
        $model = new Rtransaction();
        return $this->render('clientdetails', [
            'model' => $model,
        ]);
    }
    public function actionInvoic()
    {
        $this->layout = "invoicLayout";
        $model        = new Rtransaction();
        return $this->render('invoic', [
            'model' => $model,
        ]);
    }
    public function actionPrint()
    {
        $transaction = new Rtransaction();
        $this->setId();

        $model      = new Invoic();
        $connection = \Yii::$app->db;
        $newid      = $this->val + 1;

        $comand            = $connection->createCommand('SELECT SUM(total) FROM rtransaction where invoice_id=' . $newid)->queryScalar();
        $ord_date          = date("Y-m-d");
        $p                 = floatval($comand);
        $model->id         = $this->getId();
        $model->cost       = $p;
        $model->order_date = $ord_date;
        $model->save();
        $this->setId();

        return $this->redirect(['invoic',
            'model' => $transaction,
        ]);

    }
    public function getId()
    {

        return ++$this->val;
    }
    public function setId()
    {
        $connection = \Yii::$app->db;
        $comand2    = $connection->createCommand("SELECT id FROM invoic  ORDER by id DESC")->queryScalar();
        $this->val  = floatval($comand2);
    }
    public function getOrderNum()
    {

        return ++$this->order_num;
    }
    public function setOrderNum()
    {
        $now        = date("Y-m-d");
        $connection = \Yii::$app->db;
        $comand3    = $connection->createCommand("SELECT order_date FROM invoic ORDER by id DESC")->queryScalar();
        $comand1    = $connection->createCommand("SELECT order_num FROM invoic ORDER by id DESC")->queryScalar();
        print_r($comand3);
        $ord_num    = floatval($comand1);
        $order_date = $comand3;
        if ($now == $order_date) {
            $this->order_num = $ord_num;
        } else {
            $this->order_num = 0;
        }

    }

    /**
     * Updates an existing WholesalerOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionPartinvoic()
    {
        $this->layout = "invoicLayout";
        $model        = new Rtransaction();
        return $this->render('partinvoic', [
            'model' => $model,
        ]);
    }

    public function actionAskShift()
    {
        if (count($this->checkPermission()) > 0 ) {

            $this->layout = "resturantLayout";
            $model        = new Rtransaction();
            $dateModel    = new DateTest();
            return $this->render('ask-shift', [
                'model'     => $model,
                'dateModel' => $dateModel,
            ]);
        } else {
            return $this->redirect(['error']);
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
        if (($model = Rtransaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
