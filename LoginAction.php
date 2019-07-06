<?php
include "Connect.php";
$name = $_POST["username"];
$passwd = $_POST["password"];
$sql = "select username,password from Login where username='$name' and password='$passwd'";
$result = $connect->query($sql);
$onerow = mysqli_fetch_array($result);
// 进行分类，1.管理员 2.普通用户
if ($name == 'admin' && $passwd == "admin") {
    echo "欢迎管理员";
    //转到管理员界面
    header("location:admin.php");
} else if ($onerow) {
    echo "普通用户登陆成功";
   //跳转到普通的用户界面
    header("location:loadUser.php");
} else {
    echo"<script>
        alert('输入的账户或者密码错误');
        history.back();
        </script>";
    echo "<script>
            window.location.href=\"Main.php\"
        </script>";
}


