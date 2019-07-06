<?php
// 加载数据库的连接
include "Connect.php";
//查询数据
$sql="select *from wish";
$result=$connect->query($sql);
$data=null;
while($row=$result->fetch_assoc())
{
    $data[]=$row;
}



if(!empty($_POST))
{
    //insert插入内容
    //获取随机位置
    $rtop=mt_rand(0,300);
    $rleft=mt_rand(0,870);
    $arr=array('note1.png','note2.png','note3.png','note4.png','note5.png','note6.png');
    $pic=$arr[array_rand($arr)];
    $sqlname="insert into wish(content,user,rtop,rleft,pic)
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
?>