<?php

include "Connect.php";
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
    $sql="insert into announce(contents) value('$_POST[announce]')";
    $rs=$connect->query($sql);
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

//加载所有用户的账户、密码在界面上
$page=isset($_GET["p"])? $_GET["p"]:1;
$sql="select * from login ";
$data=$connect->query($sql);

$sql3="select count(*) from login  ";
$result=$connect->query($sql3);
$row=mysqli_fetch_array($result);
$count=$row[0];
$to_pages=ceil($count/5);



if(isset($_GET["p"])){
    $p=$_GET["p"];
    $pagesize=5;
    $pages=($p-1)*$pagesize;
    $sql2 = "select * from login limit ".$pages .",5 ";
    $data=$connect->query($sql2);
}else{
    $sql = "select * from login limit 0,5 ";
    $data=$connect->query($sql);
}

if(isset($_GET["id2"])){
    $id2=$_GET["id2"];
    $sql2="delete from login where id=$id2";

    $delete1=$connect->query($sql2);
    header("location:admin.php");
}



if(!empty($_POST))
    {
        $user=$_POST['user'];
        $emil=$_POST['emil'];
        $pass=$_POST['pass'];
        $sex=$_POST['sex'];
        $sql="insert into login(username,emil,password,sex) value ('$user','$emil','$pass','$sex')";
        $connect->query($sql);
        $ref=$_SERVER['HTTP_REFERER'];
        header("location:$ref");
    }

if(!empty($_GET['ID']))
    {
        $deID=$_GET['ID'];
        $DelSql="delete from userwish where id=$deID";
        $DeRe=$connect->query($DelSql);
        header("location:admin_wish.php");
    }


