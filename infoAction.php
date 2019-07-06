<?php
include "Connect.php";
$emil=$_POST["emil"];
$passwd=$_POST["pass"];
$sex=$_POST["sex"];
$sql="update login set password='$passwd',sex='$sex' where emil='$emil'";
$result=$connect->query($sql);
if($connect->affected_rows==1)
    {
        header('location:loadUser.php');
    }else{
    echo "<script>
        alert('输入的信息有误');
        history.back();
        </script>";
}


