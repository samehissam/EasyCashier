<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RtableSession */

$this->title = 'إضافة مقعد جديد';

?>
<div class="rtable-session-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
