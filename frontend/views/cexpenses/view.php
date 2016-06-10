<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cexpenses */

$this->title = $model->expense_id;
$this->params['breadcrumbs'][] = ['label' => 'Cexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cexpenses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->expense_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->expense_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'expense_id',
            'cost',
            'description',
            'date',
            'expense_type_id',
        ],
    ]) ?>

</div>
