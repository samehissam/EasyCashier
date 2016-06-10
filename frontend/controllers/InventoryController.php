<?php
namespace frontend\controllers;

use app\models\Inventory;
use frontend\models\InventorySearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * InventoryController implements the   CRUD actions for Inventory model.
 */
class InventoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create', 'index', 'out', 'update', 'error', 'view', 'qty-report'],
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
     * Lists all Inventory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout                       = "resturantLayout";
        $searchModel                        = new InventorySearch();
        $dataProvider                       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
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

    public function actionQtyReport()
    {

        $this->layout                       = "resturantLayout";
        $searchModel                        = new InventorySearch();
        $dataProvider                       = $searchModel->searchQty(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('qty-report', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Inventory model.
     * @param integer $InventoryId
     * @param integer $ProductId
     * @return mixed
     */
    public function actionView($InventoryId, $ProductId)
    {
        return $this->render('view', [
            'model' => $this->findModel($InventoryId, $ProductId),
        ]);
    }

    /**
     * Creates a new Inventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (count($this->checkPermission()) > 0 ) {
            $this->layout = "inventoryLayout";
            $model        = new Inventory();

            if ($model->load(Yii::$app->request->post())) {

                $connection = \Yii::$app->db;

                $qty = $connection->createCommand('SELECT ProductQty from inventory where  ProductId = ' . $model->ProductId)->queryAll();
                if (count($qty) > 0) {
                    $newQty     = $qty[0]['ProductQty'] + $model->ProductQty;
                    $update_qty = $connection->createCommand('UPDATE inventory set ProductQty= ' . $newQty . ' where ProductId = ' . $model->ProductId);
                    $update_qty->execute();
                    $productName = $connection->createCommand('SELECT ProductName from product where  ProductId = ' . $model->ProductId)->queryAll();

                    Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة الكمية الجديدة بنجاح إلي مخزون " . "<span style='font-weight: bold; font-size: 25px; color: red;'>" . $productName[0]['ProductName'] . "</span> والكمية المتاحة منه الآن " . "  </span>" . "<span  style='font-weight: bold; font-size: 25px; color: red;'>" . $newQty . "</span>");

                    return $this->redirect(['create', 'model' => $model]);

                } else {
                    $model->save();
                    Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم إضافة المنتج بنجاح إلي المخزن والكمية المتاحة منه الآن " . "<span  style='font-weight: bold; font-size: 25px; color: red;'>" . $model->ProductQty . "</span> </span>");

                    return $this->redirect(['create', 'model' => $model]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->redirect(['error']);
        }

    }
    public function actionOut()
    {
        $this->layout = "inventoryLayout";
        $model        = new Inventory();

        if ($model->load(Yii::$app->request->post())) {
            $connection = \Yii::$app->db;

            $qty = $connection->createCommand('SELECT ProductQty from inventory where  ProductId = ' . $model->ProductId)->queryAll();

            if (count($qty) > 0) {

                if ($qty[0]['ProductQty'] >= $model->ProductQty) {

                    $newQty     = $qty[0]['ProductQty'] - $model->ProductQty;
                    $update_qty = $connection->createCommand('UPDATE inventory set ProductQty= ' . $newQty . ' where ProductId = ' . $model->ProductId);
                    $update_qty->execute();
                    $productName = $connection->createCommand('SELECT ProductName from product where  ProductId = ' . $model->ProductId)->queryAll();

                    Yii::$app->getSession()->setFlash('success', "<span  style='font-weight: bold; font-size: 20px;'>تم تسجيل خروج " . "<span style='font-weight: bold; font-size: 25px; color: red;'>" . $model->ProductQty . "</span>  بنجاح من مخزون من مخزون " . "<span style='font-weight: bold; font-size: 25px; color: red;'>" . $productName[0]['ProductName'] . "</span> والكمية المتاحة منه الأن " . "  </span>" . "<span  style='font-weight: bold; font-size: 25px; color: red;'>" . $newQty . "</span>");

                    return $this->redirect(['create', 'model' => $model]);

                    /*

                else {
                Yii::$app->getSession()->setFlash('error',"<span  style='font-weight: bold; font-size: 20px;'>عفوا هذا المنتج الكمية متاحه منه بالمخزن <span  style='font-weight: bold; font-size: 25px; color: red;'>".$qty[0]['ProductQty']. " وأنته تريد خروج "."<span  style='font-weight: bold; font-size: 25px; color: red;'>".$model->ProductQty . "</span> </span\>");
                return $this->render('create',[ 'model' => $model,] );

                }*/
                } else {
                    Yii::$app->getSession()->setFlash('error', "<span  style='font-weight: bold; font-size: 20px;'>عفوا هذا المنتج الكمية المتاحه منه بالمخزن <span  style='font-weight: bold; font-size: 25px; color: red;'>" . $qty[0]['ProductQty'] . " </span> و أنته تريد خروج " . "<span  style='font-weight: bold; font-size: 25px; color: red;'>" . $model->ProductQty . "</span> </span>");
                    return $this->render('create', ['model' => $model]);

                }
            } else {

                Yii::$app->getSession()->setFlash('error', "<span  style='font-weight: bold; font-size: 20px;'>عفوا هذا المنتج لم يتم تسجيله بالمخزن من قبل تستطيع تسجيله عن طريق تحديد الكمية والضغط علي زر إضافة للمخزن</span>");
                return $this->render('create', ['model' => $model]);

            }
        }

    }

    /**
     * Updates an existing Inventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $InventoryId
     * @param integer $ProductId
     * @return mixed
     */
    public function actionUpdate($InventoryId, $ProductId)
    {
        $this->layout = "resturantLayout";
        $model        = $this->findModel($InventoryId, $ProductId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'InventoryId' => $model->InventoryId, 'ProductId' => $model->ProductId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inventory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $InventoryId
     * @param integer $ProductId
     * @return mixed
     */
    public function actionDelete($InventoryId, $ProductId)
    {
        $this->findModel($InventoryId, $ProductId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $InventoryId
     * @param integer $ProductId
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($InventoryId, $ProductId)
    {
        if (($model = Inventory::findOne(['InventoryId' => $InventoryId, 'ProductId' => $ProductId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
