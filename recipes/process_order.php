<?php

$totalCost=0;
$shirts=$_POST["shirts"];
$trousers=$_POST["trouser"];
$shirtCost=$shirts*3.5;
$trouserCost=$trousers*40.0;
$totalCost=$shirtCost+$trouserCost;
$shipping=$_POST["shipping"];
if($shipping=="regular"){
    $totalCost+=7;
}else{
   $totalCost+=9; 
}
if(isset($_POST["donation"])){
    $totalCost+=5;
}


echo "<h2>Your order</h2>";
for($i=0;$i<$shirts;$i++){
  ?>
  <img src="images/carbonara.jpg" alt="shirts"/>
  <?php
}

echo "Total cost ". $totalCost ."<br>";
echo "Thank you for your order"."<br>";
if(isset($_POST["donation"])){
    echo"Thank you for your donation";
}
?>