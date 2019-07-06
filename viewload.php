<?php
    include "Connect.php";
    $time=$_POST['time'];
    $sql="select *from userwish where optime like '$time%'";
    $result=$connect->query($sql);
    $data=null;
    while($row=$result->fetch_assoc())
    {
        $data[]=$row;
    }

$announce="select *from announce";
$re=$connect->query($announce);
$Data=null;
while ($Row=$re->fetch_assoc())
{
    $Data[]=$Row;
}
    require("review.php");
?>

