<?php
include "Connect.php";
$emil=$_POST["emil"];
$passwd=$_POST["pass"];
$repass=$_POST["repass"];
if($passwd!=$repass)
{
    echo"<script>
            alert('两次输入的密码不一致，请检查');
            history.back();
            </script>";
}else {
    $sql = "update login set password='$repass' where emil='$emil'";
    $result = $connect->query($sql);
    if ($connect->affected_rows == 1) {
       header("location:Main.php");
    } else {
        echo "<script>
                alert('输入的邮箱或密码有误');
                history.back();
                </script>";
    }
}

