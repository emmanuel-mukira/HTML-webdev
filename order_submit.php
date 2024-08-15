<!DOCTYPE html>
<html>
<body>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
	  $foodItem=$_POST['Fooditem'];
	  $quantity=$_POST['Quantity'];
	 if(!empty($foodItem) && !empty($quantity)){
      ?>
      <h1>Order successful! Here is what you ordered:</h1>
      <?php
      for($i=0;$i<$quantity;$i++){
        ?>
        <img src="images/carbonara.jpg" alt="Cookies">
        <?php
      }
	 }else{
        http_response_code(400);
        ?>
        <p>Error : Missing food item or quantity</p>
        <?php  
     }
	}
?>
</body>
</html>