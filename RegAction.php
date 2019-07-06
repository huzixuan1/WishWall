<?php
    include "Connect.php";
    $name=$_POST["name"];
    $pass=$_POST["pass"];
    $emil=$_POST["emil"];
    $sex=$_POST["sex"];

    if($name==""||$pass==""||$emil=="")
        {
            header("location:Register.php");
        }else
            {

                $sql="insert into login(username,password,emil,sex) value('$name','$pass','$emil','$sex')";
                $result=$connect->query($sql);
                if($connect->affected_rows==1)
                {
                  header("location:Main.php");
                }else
                {
                    echo "注册失败";
                    header("location:Register.php");
                }
            }








