<?php

//引入数据库配置文件
require_once 'config.php';
//数据库链接
$mysqli =new mysqli($host,$user,$pwd,$db);
if($mysqli->connect_error){
    die("数据库链接失败".$mysqli->connect_error);
}
$sql="select * from game";

$res =$mysqli->query($sql);
$className="btn img_tic";
$disable ="";
while ($row=$res->fetch_array()){
    if($row[1]==0){
        $className="btn img_tic";
        $disable="";
    }else if($row[1]==1){
        $className="btn img_tic o";
        $disable="disabled";
    }else if($row[1]==2){
        $className="btn img_tic x";
        $disable="disabled";
    }
    echo '<article class="field"><button data-id="'.$row[0].'" id="'.$row[0].'" '.$disable.'  class="'.$className.'"></button></article>';
}
$mysqli->close();
?>