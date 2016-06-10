<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CrtransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crtransactions';

?>
<div class="crtransaction-index">

 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'autoXlFormat'=>true,
    'export'=>[
        'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_BLANK
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          
            'table_table_id',
            //'id',
            'qty',
           // 
           // 'item_item_id',
           // 'total',
              [
                'attribute'=>'item_item_id',
                'value'=>'itemItem.item_name',
            ], 
            'table_session',

            ['class' => \kartik\grid\ActionColumn::className(),'template'=>'  {delete}' ],
         ],
   

     'toolbar' =>  [
       
        '{export}',
       // '{toggleData}',
        
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    //'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
   // 'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
       'heading'=>"<p class='head text-center'>المبيعات اليومية</p>  "
        
        
    ],

   
]);

    ?>
    

</div>
