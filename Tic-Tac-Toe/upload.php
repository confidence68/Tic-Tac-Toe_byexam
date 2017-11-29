<?php
 if(@is_uploaded_file($_FILES['photo']['tmp_name'])){//@符合可以屏蔽错误
     $upfile=$_FILES["photo"];
     //获取数据里面的值
     $name=iconv("UTF-8","gb2312", $upfile["name"]);//上传文件名称
     $type =$upfile["type"];//上传文件类型
     $size=$upfile["size"];//上传文件大小
     $tmp_name =$upfile["tmp_name"];//上传文件临时存放路径
     $template =$_REQUEST["template"];

     //判断上传文件类型
     switch ($type){
         case 'image/pjpeg';
         $okType =true;
         break;
         case "image/jpeg";
         $okType =true;
         break;
         case 'image/png';
         $okType =true;
         break;
     }
     if($okType){
         /**
          * 0:文件上传成功<br/>
          * 1：超过了文件大小，在php.ini文件中设置<br/>
          * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
          * 3：文件只有部分被上传<br/>
          * 4：没有文件被上传<br/>
          * 5：上传文件大小为0
          */
         $error=$upfile["error"];//上传后系统返回错误
         if($error!=0){
             echo '<script>$(".alert",".alert-spacing-error").html("<span class=underline>图片大小错误:</span> 请确认图片尺寸是否正确!!</article>")</script>';
         }else{
             cut_img($tmp_name,50,50,$name, $type);
             setcookie("headerimg", "pictures/".$name, time()+2592000);
             header("Location: index.php");
             exit();
         }
     }
 }

//图片裁剪函数
function cut_img($img,$width,$height,$imgname,$img_type){ //要裁剪突破的宽度、高度、图片类型
    list($imageWidth, $imageHeight) = getimagesize($img);
    if($img_type=='image/pjpeg' || $img_type=='image/jpeg'){
        $s = imagecreatefromjpeg($img);
    } else if($img_type == "image/png"){
        $s = imagecreatefrompng($img);
    }
    $width = imagesx($s)<$width?imagesx($s):$width;  //如果图片的宽比要求的小，则以原图宽为准
    $height = imagesy($s)<$height?imagesy($s):$height;
    $bg = imagecreatetruecolor($width,$height);
    imagecopyresampled($bg,$s,0,0,0,0,$width,$height,$imageWidth,$imageHeight);//生成50*50缩略图
    imagejpeg($bg,"pictures/".$imgname);//移动目录
    imagedestroy($s);                //关闭图片
    imagedestroy($bg);
}


?>