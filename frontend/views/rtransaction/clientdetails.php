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



$_SESSION["name"] = $_POST['name'];
$_SESSION["phone"] = $_POST['phone'];
$_SESSION["address"] = $_POST['address'];



