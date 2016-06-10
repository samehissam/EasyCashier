<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Productcategory */

$this->title = 'أقسام منتجات المخزن';

?>
<div class="productcategory-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
