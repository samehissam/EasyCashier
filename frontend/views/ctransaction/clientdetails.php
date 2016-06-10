<?php
if(!isset($_SESSION))
{
    session_start();
}
/**
 * Created by PhpStorm.
 * User: Sameh
 * Date: 9/24/2015
 * Time: 5:54 PM
 */
use yii\helpers\Html;
if(isset($_POST["c_table_num"])){
$_SESSION["c_table_num"] = $_POST['c_table_num'];
}else{

$_SESSION["table_num"]=0;	
}







