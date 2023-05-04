<?php
try{
echo "json test\n";
$key = "test";
$key2 = "test2";
//$key="U8940b91aba5a1787e847e372d585366a";
$test='{"'.$key.'":"unfollow","'.$key2.'":"follow" }';
echo $test;
$ary = json_decode($test);

echo $ary->$key;
var_dump($ary);
$ary2[$key] = "follow";
var_dump($ary2);
$ary2[$key] = "unfollow";
var_dump($ary2);
}
catch(Exception $ex){
echo "error";
echo $ex->getMessage();
}
?>
