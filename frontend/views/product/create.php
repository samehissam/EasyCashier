<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'منتجات المخزن';

?>
<div class="product-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
