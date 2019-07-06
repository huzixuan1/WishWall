<?php
// 加载数据库的连接
include "Connect.php";
//查询数据
$sql="select *from userwish";
$result=$connect->query($sql);
$data=null;
while($row=$result->fetch_assoc())
{
    $data[]=$row;
}

// read announce contents
$announce="select *from announce";
$re=$connect->query($announce);
$Data=null;
while ($Row=$re->fetch_assoc())
{
    $Data[]=$Row;
}


if(!empty($_POST))
{
    //insert插入内容
    //获取随机位置
    $rtop=mt_rand(0,300);
    $rleft=mt_rand(0,900);
    $arr=array('note1.png','note2.png','note3.png','note4.png','note5.png','note6.png');
    $pic=$arr[array_rand($arr)];
    $sqlname="insert into userwish(content,user,rtop,rleft,pic)
        values('$_POST[content]','$_POST[user]',$rtop,$rleft,'$pic')";
    $rs=$connect->query($sqlname);
    if(!$rs)
    {
        echo mysqli_error();
        exit();
    }else{

        //跳转到上一个页面
        $ref=$_SERVER['HTTP_REFERER'];
        header("location:$ref");
    }
}

// 从数据中加载完数据后，请求主页
//在主页进行展示
require('UserPlot.php');
?>
