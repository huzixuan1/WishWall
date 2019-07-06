
<?php
include "adminAction.php";
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
       id="color">发布公告
        <a href="javascript:CLI()" class="stylname"
           style="width:80px;height: 30px;
           margin-top: 60px;margin-left:10px;
           float:left;text-decoration:none;
           font-size: 20px;
           color: #040306"
           id="color">添加用户
            <a href="admin_wish.php" class="stylname"
               style="width:80px;height: 30px;
           margin-top: 60px;margin-left:10px;
           float:left;text-decoration:none;
           font-size: 20px;
           color: #040306"
               id="color">心愿管理
            </a>
        </a>
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
    <form action="adminAction.php" method="post">
        <table>
            <tr>
                <td><input type="text" name="user"
                           placeholder=" 用户名"
                           style="font-size: 20px;
                           margin-left: 30px;margin-top: 30px;
                           border-radius: 8px;border: solid gray"></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="emil"
                           placeholder=" 邮箱号"
                           style="font-size: 20px;
                           margin-left: 30px;margin-top: 10px;
                           border-radius: 8px;border: solid gray"></td>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="pass" placeholder="密码"
                           style="font-size: 20px;
                           margin-left: 30px;margin-top: 10px;
                           border-radius: 8px;border: solid gray">
                </td>
            </tr>
            <td>
                <p><select class="select" name="sex" id="border"style="font-size: 20px;
                           margin-left: 120px;margin-top: 10px;
                           border-radius: 8px;border: solid gray">
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                </p>
            </td>
            <tr>
                <td>
                    <input type="submit" value="添加" style="font-size: 20px;
                           margin-left: 50px;margin-top: 10px;width: 200px;height: 40px;
                           border-radius: 8px;border: solid gray">
                </td>
            </tr>
        </table>
    </form>

</div>

<div class="down">

    <form action="adminAction.php" method="post">
        <div style="margin-top: 100px;margin-left: 280px">
            <tr>

            </tr>

            <table  cellpadding="20px" >
                <th>用户名</th><th>密码</th><th>修改</th><th>删除</th>
                <?php
                while ($wh=mysqli_fetch_assoc($data)){
                    echo "<tr>";
                    echo"<td>".$wh["username"]."</td>";
                    echo"<td>".$wh["password"]."</td>";
                    echo"<td><a href='adminUpdate.php?id1=$wh[id]'>修改</td>";
                    echo"<td><a href='adminAction.php?id2=$wh[id]'>删除</td>";
                    echo"</tr>";
                }
                ?>
                </tr>
                <tr>
                    <?php
                    if($page<$to_pages){
                        echo"<td colspan='2'><a href='admin.php?p=".($page+1)."'>下一页</a></td>";
                    }else{
                        echo"<td colspan='2'><a href='admin.php?p=".$to_pages."'>下一页</a></td>";
                    }
                    if($page>1){
                        echo"<td colspan='8' ><a href='admin.php?p=".($page-1)."'>上一页</a></td>";
                    }else{
                        echo"<td colspan='8'><a href='admin.php?p=1'>上一页</a></td>";
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


    var num=0;
    function CLI(){
        var tab=document.getElementsByTagName('table')[0];
        if(tab.style.display.indexOf('none')>-1)
        {
            tab.style.display="block";
        }else {
            tab.style.display="none";
        }
    }

    function cli(test) {
        // alert(test);
        var div=document.getElementById('a'+test);
        num+=1;
        div.style.zIndex=num;
    }
</script>
</body>
</html>
