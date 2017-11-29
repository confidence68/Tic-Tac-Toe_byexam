<?php
$act =!empty($_REQUEST["act"])?$_REQUEST["act"]:"";
//引入数据库配置文件
require_once 'config.php';
//数据库链接
$mysqli =new mysqli($host,$user,$pwd,$db);
if($mysqli->connect_error){
    die("数据库链接失败".$mysqli->connect_error);
}
if($act=="startnewgame"){//重新开始游戏
    $sql="update `game` set status=0 where status<>0";//全部清空数据为0
    $res =$mysqli->query($sql);
    $mysqli->close();
    header("Location: index.php");
    exit();
}

else if($act=="peopleclick"){ //用户点击一次请求
    $id=$_REQUEST["id"];
    $status =$_REQUEST["status"];//status =1是人，status=2是电脑
    $sql="update `game` set status=".$status." where id=".$id;
    $res=$mysqli ->query($sql);
    if($res){
        $result["status"] =true;
        $result["mes"]="操作成功！";
        echo json_encode($result,true);
    }else{
        $result["status"] =false;
        $result["mes"]="操作失败！";
        echo json_encode($result,true);
    }
    $mysqli->close();
}

else if($act=="saveresult"){
    $name=$_POST["name"];
    $peoplestep=$_POST["peoplestep"];
    $computerstep=$_POST["computerstep"];
    $time=$_POST["time"];
    $status =1;
    $date=date("Y-m-d");
    $headerimg=$_COOKIE["headerimg"];
    $sql="insert into `user` (name,peoplestep,computerstep,time,status,date,headerimg) VALUE ('$name','$peoplestep','$computerstep','$time','$status','$date','$headerimg')";
   // var_dump($sql);
    $res =$mysqli->query($sql);
    $mysqli->close();
   header("Location: index.php");
    exit();
}

?>