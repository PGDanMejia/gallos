<?php
$rawData = $_POST['imgBase64'];
$filteredData = explode(',', $rawData);
$unencoded = base64_decode($filteredData[1]);
$randomName = rand(0, 99999);;
//Create the image 
echo getcwd();

$fp = fopen('img/fotos-perfil/'.$randomName.'.png', 'w');
fwrite($fp, $unencoded);
fclose($fp);
/*echo getcwd();
$file = fopen("test.txt","w");
echo fwrite($file,"Hello World. Testing!");
fclose($file);*/
?>;