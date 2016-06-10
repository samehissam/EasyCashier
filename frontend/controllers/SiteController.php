<?php
namespace frontend\controllers;

use app\models\Transaction;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'/*, 'signup'*/],
                'rules' => [
                   /* [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],



                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        $this->layout="indexLayout";
   // $this->accessRules();
        return $this->render('index');
    }
    public function actionExpire()
    {
        $this->layout="transactionLayout";
        // $this->accessRules();
        return $this->render('expire');
    }
    public function actionAboutus()
    {
         $this->layout="aboutLayout";
        // $this->accessRules();
        return $this->render('aboutus');
    }

    public function GetVolumeLabel($drive) {
        if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
        $volname = ' ('.$m[1].')';
        } else {
        $volname = '';
        }
        return $volname;
    }
    public function checkD(){
    $serial =trim(str_replace("(","",str_replace(")","",$this->GetVolumeLabel("c"))));
        $connection=\Yii::$app->db;
        $check=$connection->createCommand("SELECT id from checkout WHERE name
            = "."'".$serial."'")->queryAll();
        return $check;
    }

    public function checkPermission(){
        $userId=Yii::$app->user->identity->id;
        $connection=\Yii::$app->db;
        $checkAdmin=$connection->createCommand("SELECT item_name from auth_assignment WHERE user_id
            =".$userId)->queryAll();
        return $checkAdmin;

    }
    
       
     

    public function actionLogin()
    {
      
       /* $serial =trim(str_replace("(","",str_replace(")","",$this->GetVolumeLabel("c"))));*/
       /* $now = date('Y-m-d');
        $connection=\Yii::$app->db;
        $lastLoginDate= $connection->createCommand("SELECT login_date FROM login_session  ORDER by session_id DESC ")->queryOne();
        $getexpireDate= $connection->createCommand("SELECT expire_date FROM expire_date")->queryOne();

//  print_r($lastLoginDate);
        $expireDate=$getexpireDate['expire_date'];
        $chexkDate= $lastLoginDate['login_date'];*/
       /* if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        elseif ($serial=="D2ED-49E8") {
           return $this->render('login', [
                    'model' => $model,
                ]);
        }*/
         if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout="indexLayout";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
   // }

      /*  else {
            if ($chexkDate >$now || $now>$expireDate) {
                return $this->redirect(['expire']);
            } */

          
      //  }
    }
    public function actionErrorlogin(){
        return $this->render('errorlogin');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */



    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
      /*  $now = date('Y-m-d');
        $connection=\Yii::$app->db;
        $lastLoginDate= $connection->createCommand("SELECT login_date FROM login_session  ORDER by session_id DESC ")->queryOne();
        $getexpireDate= $connection->createCommand("SELECT expire_date FROM expire_date")->queryOne();

//  print_r($lastLoginDate);
        $expireDate=$getexpireDate['expire_date'];
        $chexkDate= $lastLoginDate['login_date'];*/
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        } /* else {
            if ($chexkDate >$now || $now>$expireDate) {
                return $this->redirect(['expire']);
            } */else {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }

    }

    public function actionEntry(){
        $model=new EntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }}

    /**
     * Requests password reset.
     *
     * @return mixed
     */
   /* public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }*/

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
   /* public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }*/


}
