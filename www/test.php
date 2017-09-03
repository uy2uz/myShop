<?php
$array1 = ['0'=>'a', '1'=>'b'];


$array2 = ['1'=>'0'];


//echo 'b'+'0';

//var_dump($array1); 
//var_dump($array2);


var_dump(array_merge($array1,$array2));


var_dump($array1+$array2);
