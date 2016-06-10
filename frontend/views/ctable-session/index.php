<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CtableSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ctable Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctable-session-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ctable Session', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'table_id',
            'table_state',
            'session_start',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
