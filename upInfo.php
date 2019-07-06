<?php
    include "Connect.php";
    $number=$_POST['number'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $sql="update login set username='$name',password='$password' where id='$number'";
    $result=$connect->query($sql);
    header("location:admin.php");
?>
