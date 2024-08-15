


<?php

echo "2.Associative array";
$people['Joe']=35;
$people['Sam']=36;
$people['Tom']=37;

//Other way to declare associative arrays
//$people=array("Joe"=>"35","Sam"=>"36","Tom"=>"37");
foreach($people as $name => $age){
    echo "my name is $name , and my age is $age "."</br>";
}
/*Other way to loop through Associative Arrays
$keys=array_keys($people);
$length=count(people);
for($i=0,$i<length,$i++){
    echo "Name is $keys[$i] , and my age is $people[$keys[$i]] "."</br>";
}
*/
$data=[
    'Game of Thrones' => ['Jaime Lannister','Catalyn Stark','Cersei Lannister'],
    'Black Mirror'=>['Nanette Cole','Selma Telse','Karin Parke']
];

foreach($data as $title => $actors){
    echo "<h2>$title</h2>";
    foreach($actors as $actor){
      echo "<div>$actor</div>";
    }
}

echo "3.Multidimensional arrays ". "<br>";
$names= array(
    array("Alice", "Bob", "Charlie"), // First sub-array
    array("David", "Eve", "Frank")    // Second sub-array
);

// Print the specific element "Eve"
//1.Using specific dimensions or index
print_r($names[1][1]);
//2.Using for each loop
foreach($data as $title => $actors){
    echo "<h2>$title</h2>";
    foreach($actors as $actor){
      echo "<div>$actor</div>";
    }
}
//3.Using for loop

$coordinates = array(
    "Lebanon" => array(
        "Latitude" => "33.8938° N",
        "Longitude" => "35.5018° E",
        "City" => "Beirut",
        "Language" => array(
        "Lebanese Arabic",
        "French",
        "English"
        )
    ),
    "Norway" => array(
        "Latitude" => "59.9139° N",
        "Longitude" => "10.7522° E",
        "City" => "Oslo",
        "Language" => array(
        "Norwegian",
        "Sami"
        )
    ),
    "Switzerland" => array(
        "Latitude" => "47.3769° N",
        "Longitude" => "8.5417° E",
        "City" => "Zürich",
        "Language" => array(
                    "German",
                    "French",
                    "Italian",
                    "Romansh"
                )
     )
);

foreach($coordinates as $country=>$details){
  $city=$details['City'];
  $latitude=$details['Latitude'];
  $longitude=$details['Longitude'];
  $Language=$details['Language'][0];
  echo "<ul>";
  echo"<li>"."<strong>$city </strong> is a city in <strong>$country</strong> located at <strong>$latitude</strong> and <strong>$longitude</strong> and they speak <strong>$Language</strong> "."</li>";
  echo "</ul>";
}

?>
<!DOCTYPE html>
 <html>
  <body>
   <form action="order_submit.php" method="post">
    <label for="Fooditem">Food item:</label>
    <select name="Fooditem">
      <option value="Cookie">Cookie</option>
      <option value="Cake">Cake</option>
    </select><br>
    <Label>Quantity: </Label>
    <input type="number" name="Quantity" value="1"></input><br>
    <input type="submit" value="Order">
   </form>
  </body>
 </html>