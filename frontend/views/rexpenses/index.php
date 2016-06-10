<?php

use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'Ritems';


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
                'attribute'=> 'expense_type_id',
                'value'=>'expenseType.name',
            ], 


            //'expense_id',
            'cost',
            'description',
            'date',
            

            

           // ['class' => '\kartik\grid\ActionColumn'],
         ],
   
        'exportConfig' => [
            
            GridView::PDF => [],
            
        ],
     'toolbar' =>  [
       
        '{export}',
        '{toggleData}',
        
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
        'heading'=>"<p class='head text-center'>المصروفات</p>  "
        
    ],

   
]);

    ?>
    

</div>
