<?php
use kartik\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Html;

/*foreach ($lista as $key ) {
	# code...
	echo $key["BranchName"];
}*/

echo GridView::widget([
    'dataProvider'=>$lista,
    //'filterModel'=>$searchModel,
    'autoXlFormat'=>true,
    'export'=>[
        'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_SELF
    ],
    'exportConfig' => [
             
            GridView::PDF => [],
           
        ],

    'columns' => [

    		
         [
            'attribute'=>'name',
            'pageSummary'=>'إجمالي المصروفات'
         ],
            
            [
            'attribute'=>'cost',
            'format'=>['decimal', 2], 
            //'hAlign'=>'right', 
            'width'=>'100px', 
            'pageSummary'=>true
        ],
            
            'description',
           /* [
            'attribute'=>'date',
           // 'format'=>['decimal', 2], 
            //'hAlign'=>'right', 
            'width'=>'200px', 
            
        ],*/


            
            

            /*'BranchId',
            'BranchName',
            'BranchAddress',*/
//['class' => '\kartik\grid\ActionColumn'],
           
        ],
   

     'toolbar' =>  [
       
        '{export}',
        //'{toggleData}',
        
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    //'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading'=> "<p class='head'>تقرير المصروفات ليوم  ".$day ."</p>",
        

        
        
    ],

   
]);
