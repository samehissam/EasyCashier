<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ctransaction */

$this->title = 'Create Ctransaction';

?>
<div class="ctransaction-create">

   
<?= $this->render('_form', [
        'model' => $model,
        'modelsTransaction'=>$modelsTransaction,
        'modelCustomer' => $modelCustomer,
    ]) ?>

</div>
