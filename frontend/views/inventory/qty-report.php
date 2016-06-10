<?php

use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'تقرير البالغ حد الطلب';


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
           

            [
                'attribute'=> 'ProductId',
                'value'=>'productName.ProductName',
            ], 
            
            'ProductQty',
            
            

            

           // ['class' => '\kartik\grid\ActionColumn'],
         ],
   
        'exportConfig' => [
            
            GridView::PDF => [],
           
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
        'heading'=>'<span style="font-size:30px;"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;&nbsp; تقرير المنتجات التي بلغت حد الطلب </span> '
        
    ],

   
]);

    ?>
    

</div>
