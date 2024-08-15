<?php
 function getProduct($x,$y){
    $product=$x*$y;
    return $product;
 }
 $firstNumber=$_POST["firstNumber"];
 $secondNumber=$_POST["secondNumber"];
 $product=getProduct($firstNumber,$secondNumber);
 echo $product;
?>