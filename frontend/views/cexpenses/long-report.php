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
        'target'=>GridView::TARGET_BLANK
    ],
    'exportConfig' => [
              
            GridView::PDF => [],
          
        ],

    'columns' => [

    	 [
        'class' => '\kartik\grid\SerialColumn'
    ],	
         [
            'attribute'=>'name',
            //'label'=>'الوصف',
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
            [
            'attribute'=>'date',
           
            'width'=>'200px', 
            
        ],


            
            

            /*'BranchId',
            'BranchName',
            'BranchAddress',*/

           
        ],
   

     'toolbar' =>  [
       
        '{export}',
      // '{toggleData}',
       //'{pager}'
        
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
        'heading'=>"<h4>تقرير المصروفات للفترة من يوم ".$start."  إلي يوم  ".$end."</h4>"
        
    ],

   
]);



