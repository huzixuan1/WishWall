<?php
include "Connect.php";
include "adminAction.php";
$page=isset($_GET["p"])? $_GET["p"]:1;
$sql="select * from userwish ";
$data=$connect->query($sql);

$sql3="select count(*) from userwish  ";
$result=$connect->query($sql3);
$row=mysqli_fetch_array($result);
$count=$row[0];
$to_pages=ceil($count/5);

if(isset($_GET["p"])){
    $p=$_GET["p"];
    $pagesize=5;
    $pages=($p-1)*$pagesize;
    $sql2 = "select * from userwish limit ".$pages .",5 ";
    $data=$connect->query($sql2);
}else{
    $sql = "select * from userwish limit 0,5 ";
    $data=$connect->query($sql);
}

if(isset($_GET["id2"])){
    $id2=$_GET["id2"];
    $sql2="delete from userwish where id=$id2";

    $delete1=$connect->query($sql2);
    header("location:admin_wish.php");
}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="UserStyle.css">
    <link rel="stylesheet" href="show.css">
    <style>
        body{
            background: url("images/bg.jpg");
        }

        #color:hover{
            background-color: #ff9f29;
        }

        .title{
            width: 600px;
            height: 100px;
            margin-top: 20px;
            margin-left: 400px;
            border: solid #ffffff;
            background: white;
            opacity: 0.6;
            border-radius: 8px;
        }
        .down{
            width:900px;
            height: 600px;
            margin-left: 280px;
            border: solid #ffffff;

        }
        .stylname{
            /*color: #ffc741;*/
            background: #00bf00;
            /*border: #040306;*/
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="title">
    <a href="javascript:showDialog()" class="stylname"
       style="width:80px;height: 30px;
           margin-top: 60px;margin-left:335px;
           float:left;text-decoration:none;
           font-size: 20px;
           color: #040306"
       id="color">发布公告</a>
    </a>
    <p style="float: left;margin-top: -30px">
    <div class="case" style="margin-left: 60px;margin-top: -80px;width: 330px;height:30px">
        <div class="part1">
            <img src="images/shout.png">
        </div>
        <?php
        foreach ($Data as $news) {?>
            <div class="part2" id="part2">
                <div id="scroll1">
                    <?php foreach ($Data as $num){?>
                        <ul>
                            <li>
                                <?php echo $num['contents'];?>
                            </li>
                        </ul>
                    <?php }?>
                </div> <div id="scroll2"></div> </div>
        <?php }?>
    </div>
    </p>
</div>

<div style="margin-top: 80px;float: right;
    width: 300px;height: 300px;">
</div>

<div class="down">

    <form action="adminAction.php" method="post">
        <div style="margin-top: 100px;margin-left: 280px">
            <tr>

            </tr>

            <table  cellpadding="20px" >

                <th>序号</th></th><th>心愿</th><th>操作</th>
                <?php
                while ($wh=mysqli_fetch_assoc($data)){
                    echo"<tr>";
                    echo "<td>". $wh["id"]."</td>";
                    echo "<td>". $wh["content"]."</td>";
                    echo "<td><a href='adminAction.php?ID=$wh[id]'>删除</td>";
                    echo"</tr>";
                }
                ?>
                </tr>
                <tr>
                    <?php
                    if($page<$to_pages){
                        echo"<td colspan='2'><a href='admin_wish.php?p=".($page+1)."'>下一页</a></td>";
                    }else{
                        echo"<td colspan='2'><a href='admin_wish.php?p=".$to_pages."'>下一页</a></td>";
                    }
                    if($page>1){
                        echo"<td colspan='8' ><a href='admin_wish.php?p=".($page-1)."'>上一页</a></td>";
                    }else{
                        echo"<td colspan='8'><a href='admin_wish.php?p=1'>上一页</a></td>";
                    }
                    ?>
                </tr>
            </table>
        </div>
    </form>
</div>


<form action="adminAction.php" method="post">
    <div class="ui-mask" id="mask" onselectstart="return false"></div>
    <div class="ui-dialog" id="dialogMove" onselectstart='return false;'>
        <div class="ui-dialog-title" id="dialogDrag"  onselectstart="return false;" >
            发布公告
            <a class="ui-dialog-closebutton" href="javascript:hideDialog();"></a>
        </div>
        <div class="ui-dialog-content">
            <div class="ui-dialog-l40 ui-dialog-pt15">
                <textarea name="announce" cols="43" rows="5" style="resize: none"></textarea>
            </div>
            <div>
                <a><input class="ui-dialog-submit" value="发布" type="submit"></a>
            </div>
        </div>
    </div>
</form>


<script type="text/javascript">
    var dialogInstace , onMoveStartId;	//	用于记录当前可拖拽的对象

    // var zIndex = 9000;

    //	获取元素对象
    function g(id){return document.getElementById(id);}

    //	自动居中元素（el = Element）
    function autoCenter( el ){
        var bodyW = document.documentElement.clientWidth;
        var bodyH = document.documentElement.clientHeight;

        var elW = el.offsetWidth;
        var elH = el.offsetHeight;

        el.style.left = (bodyW-elW)/2 + 'px';
        el.style.top = (bodyH-elH)/2 + 'px';

    }

    //	自动扩展元素到全部显示区域
    function fillToBody( el ){
        el.style.width  = document.documentElement.clientWidth  +'px';
        el.style.height = document.documentElement.clientHeight + 'px';
    }

    //	Dialog实例化的方法
    function Dialog( dragId , moveId ){

        var instace = {} ;

        instace.dragElement  = g(dragId);	//	允许执行 拖拽操作 的元素
        instace.moveElement  = g(moveId);	//	拖拽操作时，移动的元素

        instace.mouseOffsetLeft = 0;			//	拖拽操作时，移动元素的起始 X 点
        instace.mouseOffsetTop = 0;			//	拖拽操作时，移动元素的起始 Y 点

        instace.dragElement.addEventListener('mousedown',function(e){

            var e = e || window.event;

            dialogInstace = instace;
            instace.mouseOffsetLeft = e.pageX - instace.moveElement.offsetLeft ;
            instace.mouseOffsetTop  = e.pageY - instace.moveElement.offsetTop ;
        })

        return instace;
    }

    //	在页面中侦听 鼠标弹起事件
    document.onmouseup = function(e){

        dialogInstace = false;
        clearInterval(onMoveStartId);

    }

    //	在页面中侦听 鼠标移动事件
    document.onmousemove = function(e) {
        var e = e || window.event;
        var instace = dialogInstace;
        if (instace) {

            var maxX = document.documentElement.clientWidth -  instace.moveElement.offsetWidth;
            var maxY = document.documentElement.clientHeight - instace.moveElement.offsetHeight ;

            instace.moveElement.style.left = Math.min( Math.max( ( e.pageX - instace.mouseOffsetLeft) , 0 ) , maxX) + "px";
            instace.moveElement.style.top  = Math.min( Math.max( ( e.pageY - instace.mouseOffsetTop ) , 0 ) , maxY) + "px";
        }
        if(e.stopPropagation) {
            e.stopPropagation();
        } else {
            e.cancelBubble = true;
        }
    };

    //	拖拽对话框实例对象
    Dialog('dialogDrag','dialogMove');

    function onMoveStart(){

    }

    //	重新调整对话框的位置和遮罩，并且展现
    function showDialog(){
        g('dialogMove').style.display = 'block';
        g('mask').style.display = 'block';
        autoCenter( g('dialogMove') );
        fillToBody( g('mask') );
    }

    //	关闭对话框
    function hideDialog(){
        g('dialogMove').style.display = 'none';
        g('mask').style.display = 'none';
    }
    //	侦听浏览器窗口大小变化
    //window.onresize = showDialog;

    //对于轮转图的修饰
    var PartArea = document.getElementById('part2');
    var Scroll1 = document.getElementById('scroll1');
    var Scroll2 = document.getElementById('scroll2');

    Scroll2.innerHTML = Scroll1.innerHTML;

    function roll() {
        if(Scroll2.offsetHeight - PartArea.scrollTop <= 0) {
            PartArea.scrollTop -= Scroll1.offsetHeight;
        } else {
            PartArea.scrollTop++;
        }
    }

    var StopRoll = setInterval(roll, 60);

    PartArea.onmouseover = function () {
        clearInterval(StopRoll);
    }
    PartArea.onmouseout = function () {
        StopRoll = setInterval(roll, 60);
    }

</script>
</body>
</html>

