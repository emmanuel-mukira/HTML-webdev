
<!-- // $namesArray = array(
//     array("Alice", "Bob", "Charlie"), // First sub-array
//     array("David", "Eve", "Frank")    // Second sub-array
// );

// // Print the specific element "Eve"
// print_r($namesArray);  -->
<!-- 
<?php
$people=[
    "Joe"=>22,
    "Adam"=>34,
    "Sarah"=>29
];

foreach($people as $name => $age){
    echo "my name is $name , and my age is $age "."</br>";
}
?> -->

<?php
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