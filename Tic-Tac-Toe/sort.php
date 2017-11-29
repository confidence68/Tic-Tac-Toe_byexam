<?php

//引入数据库配置文件
require_once 'config.php';
//数据库链接
$mysqli =new mysqli($host,$user,$pwd,$db);
if($mysqli->connect_error){
    die("数据库链接失败".$mysqli->connect_error);
}
$sql="select * from user";
$res =$mysqli->query($sql);
$index =0;
while ($row=$res->fetch_array()){
    $index++;
    echo '<article class="score">'.
        '<h4 class="pos" style="background-image: url('.$row[4].')">'.$index.'</h4><h4 class="name-high">'.$row[1].' <span class="moves"><span>'.$row[2].'</span>-<span>'.$row[3].'</span></span></h4>'.
        '<p><span class="date-high">'.$row[6].'</span><span class="time-high">'.$row[5].'</span></p>'.
        '</article>';
}
$mysqli->close();
?>